<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'input_nama_role' => 'required', 'string',
        ]);

        $model = new Role();
        $model->nama = $request->input('input_nama_role');
        $model->save();
        toast("Role berhasil ditambah", "success");
        return redirect()->route('contact.index');
    }

    public function destroy($id)
    {
        try {
            $data = Role::where('id', $id)->firstOrFail();
            $data->delete();
            toast('Data berhasil dihapus!', 'success');
            return redirect()->route('contact.index');
        } catch (\Exception $e) {
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
