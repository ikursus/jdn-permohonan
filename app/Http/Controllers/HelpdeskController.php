<?php

namespace App\Http\Controllers;

use App\Models\Helpdesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HelpdeskController extends Controller
{
    /**
     * Display list of helpdesk tickets
     */
    public function index()
    {
        // $senaraiTickets = DB::table('helpdesk')->get();
        // $senaraiTickets = Helpdesk::all();
        $senaraiTiket = Helpdesk::where('user_id', '=', auth()->id())->paginate(10);

        return view('pemohon.helpdesk.template-senarai', compact('senaraiTiket'));

    }

    /**
     * Show form for creating new ticket
     */
    public function create()
    {
        return view('pemohon.helpdesk.template-baru');
    }

    /**
     * Store new helpdesk ticket
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|min:10|max:255',
            'category' => 'required|in:General,Technical,Application,Document,Account',
            'priority' => 'required|in:Low,Medium,High,Urgent',
            'description' => 'required|string|min:20|max:2000'
        ]);

        // Generate unique ticket ID
        $ticketId = 'HD' . date('Ymd') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        // Ensure ticket ID is unique
        while (Helpdesk::where('ticket_id', $ticketId)->exists()) {
            $ticketId = 'HD' . date('Ymd') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        }

        // Cara 1 simpan data dalam table helpdesk menggunakan Model new object
        // $helpdesk = new Helpdesk();
        // $helpdesk->ticket_id = $ticketId;
        // $helpdesk->user_id = auth()->id();
        // $helpdesk->subject = $request->subject;
        // $helpdesk->category = $request->category;
        // $helpdesk->description = $request->description;
        // $helpdesk->status = 'Open';
        // $helpdesk->priority = $request->priority;
        // $helpdesk->save();

        // Cara 2 simpan data dalam table helpdesk menggunakan Model create
        Helpdesk::create([
            'ticket_id' => $ticketId,
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'category' => $request->category,
            'description' => $request->description,
            'status' => 'Open',
            'priority' => $request->priority
        ]);

        // $helpdesk = Helpdesk::create([
        //     'ticket_id' => $ticketId,
        //     'user_id' => auth()->id(),
        //     'subject' => $request->subject,
        //     'category' => $request->category,
        //     'description' => $request->description,
        //     'status' => 'Open',
        //     'priority' => $request->priority
        // ]);

        return redirect()->route('pemohon.helpdesk.senarai')
                        ->with('success', 'Tiket helpdesk berjaya dicipta dengan ID: ' . $ticketId);
    }

    /**
     * Display specific ticket
     */
    // public function show($id)
    public function show(Helpdesk $helpdesk)
    {
        // $helpdesk = Helpdesk::where('id', '=', $id)->first();
        // $helpdesk = Helpdesk::where('id', '=', $id)->firstOrFail();
        // $helpdesk = Helpdesk::where('id', '=', $id)->firstOrCreate(['ticket_id' => '1abc']);

        // $helpdesk = Helpdesk::find($id);
        // $helpdesk = Helpdesk::findOrFail($id);

        return view('pemohon.helpdesk.template-detail', compact('helpdesk'));
    }

    /**
     * Store reply to ticket
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reply(Request $request, $id)
    {
        // Validate ID
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->route('pemohon.helpdesk.senarai')
                ->with('error', 'ID tiket tidak sah.');
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'balasan' => 'required|string|max:2000',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ], [
            'balasan.required' => 'Balasan wajib diisi',
            'balasan.max' => 'Balasan tidak boleh melebihi 2000 aksara',
            'lampiran.mimes' => 'Lampiran mesti dalam format PDF, JPG, JPEG, PNG, DOC atau DOCX',
            'lampiran.max' => 'Saiz lampiran tidak boleh melebihi 5MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Here you would typically save reply to database
            // Example: HelpdeskReply::create($validatedData);
            
            return redirect()->route('pemohon.helpdesk.detail', $id)
                            ->with('success', 'Balasan berjaya dihantar!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ralat berlaku semasa menghantar balasan. Sila cuba lagi.')
                ->withInput();
        }
    }
}