<?php

namespace App\Http\Controllers;

use App\Models\ContactService;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = ContactService::all();
        $roles = Role::all();
        $title = 'Yakin hapus?';
        $text = "Data akan terhapus permanen!";
        confirmDelete($title, $text);
        return view('admin.contact.contact-index', compact('contacts', 'roles'));
    }

    public function store(Request $request)
    {
        $contact = new ContactService();
        $contact->nama = $request->input_nama;
        $contact->no_telp = $request->input_no_telp;
        $contact->role_id = $request->input_role;
        $contact->save();
        toast("Kontak berhasil ditambah", "success");
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            $data = ContactService::where('id', $id)->firstOrFail();
            $data->delete();
            toast('Data berhasil dihapus!', 'success');
            return redirect()->route('contact.index');
        } catch (ModelNotFoundException $e) {
            toast('Data tidak ditemukan!', 'error');
            return redirect()->route('contact.index')->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            logger()->error($e->getMessage());

            toast('Terjadi error, Data gagal dihapus! '+$e, 'error');
            return redirect()->route('contact.index')->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
