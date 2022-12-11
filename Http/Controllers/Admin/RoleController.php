<?php

namespace Modules\Core\Http\Controllers\Admin;

use ApiResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Core\Contracts\AdminPage;
use Modules\Core\Http\Requests\RoleRequest;
use Modules\Core\Tables\RoleTable;
use Omaicode\Permission\Models\Permission;
use Omaicode\Permission\Models\Role;

class RoleController extends Controller
{
    protected $request;
    protected $adminPage;
    protected $breadcrumb;

    public function __construct(Request $request, AdminPage $adminPage)
    {
        $this->middleware('can:system.roles.create', ['create', 'store']);
        $this->middleware('can:system.roles.edit', ['edit', 'update']);
        $this->middleware('can:system.roles.delete', ['deletes']);
        $this->middleware('can:system.roles.view', ['index']);

        $this->request   = $request;
        $this->adminPage = $adminPage;
        $this->breadcrumb = [
            [
                'title'  => __('core::menu.system'), 
                'url'    => '#',
            ],
            [
                'title'  => __('core::menu.system.roles'), 
                'url'    => route('admin.system.roles.index'),
            ]
        ];         
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $table = new RoleTable();

        return $this->adminPage
        ->title('core::messages.roles.title')
        ->breadcrumb($this->breadcrumb)
        ->body($table);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $permissions = $this->getPermissions();
        $breadcrumb = $this->breadcrumb;
        $breadcrumb[] = [
                'title'  => __('core::messages.roles.create'), 
                'url'    => route('admin.system.roles.create'),
        ];

        return $this->adminPage
        ->title('core::messages.roles.title')
        ->breadcrumb($breadcrumb)
        ->body('core::pages.roles.form', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RoleRequest $request)
    {
        $data = $request->only(['name']);
        $data['guard_name'] = 'admins';

        $role = Role::create($data);
        $role->syncPermissions($request->get('permissions', []));

        if($request->after_save == 1) {
            return redirect()->route('admin.system.roles.edit', ['role' => $role->id])->with('toast_success', __('core::messages.saved'));
        }

        return redirect()->route('admin.system.roles.index')->with('toast_success', __('core::messages.saved'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $role = Role::findById($id);
        if(!$role) return abort(404);

        $role_permissions = $role->getAllPermissions()->pluck('name')->toArray();
        $permissions = $this->getPermissions();
        $breadcrumb = $this->breadcrumb;
        $breadcrumb[] = [
                'title'  => __('core::messages.roles.edit'), 
                'url'    => route('admin.system.roles.edit', ['role' => $id]),
        ];

        return $this->adminPage
        ->title('core::messages.roles.title')
        ->breadcrumb($breadcrumb)
        ->body('core::pages.roles.form', compact('permissions', 'role', 'role_permissions'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findById($id);
        if(!$role) return abort(404);

        $role->update($request->only(['name']));
        $role->syncPermissions($request->get('permissions', []));

        if($request->after_save == 1) {
            return redirect()->route('admin.system.roles.edit', ['role' => $role->id])->with('toast_success', __('core::messages.saved'));
        }        

        return redirect()->route('admin.system.roles.index')->with('toast_success', __('core::messages.saved'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function deletes($id)
    {
        $rows = $this->request->rows;
        Role::whereIn('id', $rows)->delete();

        return ApiResponse::success();
    }

    private function getPermissions()
    {
        $permissions = Permission::where('guard_name', 'admins')->get();
        $groups     = collect();
        $sub_groups = collect();
    
        foreach($permissions as $permission) {
            $splited = explode('.', $permission->name);
            $groups->add($splited[0]);
        }
    
        $groups = $groups->unique();
        foreach($groups as $group) {
            $grp_len = strlen($group);
            $sub_groups[Str::headline($group)] = $permissions
            ->filter(fn($permission) => substr($permission->name, 0, $grp_len) == $group)
            ->values()
            ->pluck('name')
            ->toArray();
        }        

        return $sub_groups;
    }
}
