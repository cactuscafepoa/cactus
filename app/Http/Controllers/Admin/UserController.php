<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User\Permissions;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller {

	public function index(Request $request) {
		$dataset = User::with('permissions')
		->orderBy('users.name')
		->get();
		$mensagem = $request->session()->get('mensagem');
		return view('admin.user.index', compact('dataset', 'mensagem'));
	}

	public function create()
	{
		return view('admin.user.create', [
            'users' => User::all('id','name')->sortBy('name'),
	        ]);
	}

	public function store(UserFormRequest $request)
	{
        $dataset = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->givePermissionTo('user');
		$request->session()->flash('mensagem',"Usuário cadastrado com sucesso: {$dataset->name}.");
		return redirect()->route('listar_usuarios');
	}

   /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
		$dataset = User::with('permissions')
		->where('id',$request->id)
		->orderBy('users.name')
		->get();   //dd($dataset);

        $permissoes = Permissions::all('id','name')->sortBy('name');

		return view('admin.user.edit', [
        	'dataset' => $dataset,
			'permissoes' => $permissoes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, User $user)
	{
		if ($request->password)	{

			$dataset = DB::table('users')
			->where('id', $request->id)
			->update([
				'name' 			=> $request->name,
				'email' 		=> $request->email,
				'password' 		=> $request->password,
			]);
		}
		else {
			$dataset = DB::table('users')
			->where('id', $request->id)
			->update([
				'name' 			=> $request->name,
				'email' 		=> $request->email,				
			]);			
		}

		$dataset = DB::table('model_has_permissions')
		->where('permission_id', $request->id_papel)
		->where('model_id', $request->id)
		->update([
			'permission_id' => $request->permission_id,			
		]);		

		$request->session()->flash("mensagem","Usuário atualizado com sucesso: {$request->name}.");
		return redirect()->route('listar_usuarios');
    }

	public function destroy(Request $request) {
		User::destroy($request->id);
		$request->session()->flash('mensagem',"Usuário removido com sucesso.");
		return redirect()->route('listar_usuarios');
	}
}