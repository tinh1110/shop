<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
class MenuController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService)
{
        $this->menuService = $menuService;
        //aaaaabb
}
    public function create (){
        return view('admin.menu.add',[
            'title' => 'Thêm danh mục',
            'menus' => $this->menuService->getParent(),
        ]);
    }
    public function store(CreateFormRequest $request){
        $this->menuService->create($request);

        return redirect()->back();
    }
    public function index(){
        return view('admin.menu.list',[
            'title' => 'Danh sách danh mục mới nhất',
            'menus'=>$this->menuService->getAll(),
        ]);
    }
    public function show(Menu $menu) {
        return view('admin.menu.edit',[
            'title' => 'Chỉnh sửa danh mục: '. $menu->name,
            'menu'=>$menu,
            'menus' => $this->menuService->getParent()
        ]);
    }
    public function update(Menu $menu , CreateFormRequest $request)
    {
        $this->menuService->update($request,$menu);
        return redirect('admin/menus/list');
    }
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->menuService->destroy($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'xóa thành công'
            ]);
        }
        return response()->json([
           'error'=>true
        ]);
    }
}
