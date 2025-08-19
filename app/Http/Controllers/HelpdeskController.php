<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class HelpdeskController extends Controller
{
    /**
     * Display list of helpdesk tickets
     */
    public function index()
    {
        return view('pemohon.helpdesk.template-senarai');
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
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'subjek' => 'required|string|max:255',
            'kategori' => 'required|string|in:teknikal,akaun,permohonan,lain-lain',
            'keutamaan' => 'required|string|in:rendah,sederhana,tinggi,kritikal',
            'mesej' => 'required|string|max:2000',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ], [
            'subjek.required' => 'Subjek wajib diisi',
            'subjek.max' => 'Subjek tidak boleh melebihi 255 aksara',
            'kategori.required' => 'Kategori wajib dipilih',
            'kategori.in' => 'Kategori yang dipilih tidak sah',
            'keutamaan.required' => 'Tahap keutamaan wajib dipilih',
            'keutamaan.in' => 'Tahap keutamaan yang dipilih tidak sah',
            'mesej.required' => 'Mesej wajib diisi',
            'mesej.max' => 'Mesej tidak boleh melebihi 2000 aksara',
            'lampiran.mimes' => 'Lampiran mesti dalam format PDF, JPG, JPEG, PNG, DOC atau DOCX',
            'lampiran.max' => 'Saiz lampiran tidak boleh melebihi 5MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Here you would typically save to database
            // Example: HelpdeskTicket::create($validatedData);
            
            return redirect()->route('pemohon.helpdesk.senarai')
                            ->with('success', 'Tiket berjaya dihantar!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Ralat berlaku semasa menghantar tiket. Sila cuba lagi.')
                ->withInput();
        }
    }

    /**
     * Display specific ticket
     */
    public function show($id)
    {
        return view('pemohon.helpdesk.template-detail', compact('id'));
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