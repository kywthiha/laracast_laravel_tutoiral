<?php

namespace App\Http\Controllers;

use App\Ability;
use App\Article;
use App\Http\Requests\RoleRequest;
use App\Repositories\RoleRepository;
use App\Role;
use App\Services\RoleService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RoleController extends Controller
{

    /**
     * @var RoleService
     */
    private $roleService;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(RoleService $roleService, RoleRepository $roleRepository)
    {
        $this->middleware('auth');
        $this->authorizeResource(Role::class, 'role');
        $this->roleService = $roleService;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $roles = $this->roleRepository->withAll();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $abilities = $this->roleRepository->allAbility();
        return view('roles.create',compact('abilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(RoleRequest $request)
    {
        $role= new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->abilities = $request->abilities;
        $this->roleService->create($role,Auth::id());
        return redirect(route('roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return RedirectResponse|Redirector
     */
    public function show(Role $role)
    {
        return redirect(route('roles.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Factory|View
     */
    public function edit(Role $role)
    {
        return view('roles.edit',['role'=>$role,'abilities'=>$this->roleRepository->allAbility()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse|Redirector
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->name = $request->name;
        $role->description = $request->description;
        $role->abilities = $request->abilities;
        $role = $this->roleService->update($role,Auth::id());
        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Role $role)
    {
        $this->roleService->delete($role->id);
        return redirect(route('roles.index'));
    }

}
