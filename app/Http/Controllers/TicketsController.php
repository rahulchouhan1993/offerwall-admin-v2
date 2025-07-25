<?php

namespace App\Http\Controllers;

use App\Helpers\HtmlCleaner;
use App\Models\Tickets;
use App\Models\TicketsChats;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{

    public function getChatConversation(Request $request, $ticketId)
    {
        $ticket = Tickets::with(['tracking:id,offer_name', 'lastchat'])
            ->where('id', $ticketId)
            ->first();

        $messages = TicketsChats::where('ticket_id', $ticketId)
            ->orderBy('created_at', 'ASC')
            ->get();

        TicketsChats::where('ticket_id', $ticketId)
            ->update(['is_read_admin' => 1]);

        return response()->json([
            'ticket' => $ticket,
            'messages' => $messages
        ]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'message'   => 'nullable|string',
            // 'media'     => 'nullable|file|max:10240', // Max 10 MB
        ]);

        $chat = new TicketsChats();
        $chat->ticket_id = $request->ticket_id;
        $chat->from = 'admin';
        
        $cleanMessage = HtmlCleaner::clean($request->input('message'));

        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // Suppress HTML5 warnings

        $dom->loadHTML(mb_convert_encoding($cleanMessage, 'HTML-ENTITIES', 'UTF-8'));

        $anchors = $dom->getElementsByTagName('a');
        foreach ($anchors as $a) {
            if (!$a->hasAttribute('target')) {
                $a->setAttribute('target', '_blank');
            }
        }

        // Extract only the inner HTML from <body> to avoid <html><body> wrapper
        $body = $dom->getElementsByTagName('body')->item(0);
        $finalHtml = '';
        foreach ($body->childNodes as $child) {
            $finalHtml .= $dom->saveHTML($child);
        }

        $chat->message = $finalHtml;
        $chat->save();

        Tickets::where('id',$request->ticket_id)->update(['updated_at'=>Carbon::now()->format('Y-m-d H:i:s')]);

        return response()->json(['success' => true, 'message' => 'Message sent']);
    }


    public function close(Request $request)
    {
        $ticket = Tickets::find($request->ticket_id);

        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'Ticket not found']);
        }

        $ticket->status = 2;
        $ticket->save();

        return response()->json(['success' => true, 'message' => 'Ticket Closed.']);
    }

    public function refreshTickets()
    {
        $query = Tickets::with(['lastchat', 'user', 'tracking'])->orderBy('updated_at','DESC');

        if(request()->query('status') == "opened"){
            $query->whereDoesntHave('chats', function ($q) {
                $q->where('is_read_admin', 1);
            });
        }

        if(request()->query('status') == "in_process"){
            $query->whereHas('chats', function ($q) {
                $q->where('is_read_admin', 1); // at least one seen chat
            })->where('status', '!=', 2);
        }

        if(request()->query('status') == "closed"){
            $query->where('status',2);
        }

        $tickets = $query->get();

        return view('dashboard.ticket-list', compact('tickets'));
    }

    public function uploadAttachment(Request $request)
    {

        $request->validate([
            'attachment'     => 'required|file|max:10240'
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('chat_media', $filename, 'public'); // stored in storage/app/public/attachments

            $url = asset('storage/' . $path);

            return response()->json([
                'success' => true,
                'url' => $url
            ]);
        }

        return response()->json(['success' => false], 400);
    }
    
}
