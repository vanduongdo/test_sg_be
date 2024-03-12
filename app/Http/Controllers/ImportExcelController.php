<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Group;

use PhpOffice\PhpSpreadsheet\IOFactory;


class ImportExcelController extends Controller
{
    function index()
    {
        $data = Group::with('products')->get();
        return view('welcome', compact('data'));
    }

    function import(Request $request)
    {
        $this->validate($request, [
            'select_file' => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('select_file')->getRealPath();
        $data = IOFactory::load($path)->getActiveSheet();
        $skipFirstIteration = true;
        if (isset($data)) {
            foreach ($data->toArray() as $key => $value) {
                if ($skipFirstIteration) {
                    $skipFirstIteration = false;
                    continue;
                }
                // var_dump($value);
                if ($value[0]) {
                    $group = Group::firstOrNew(['group_name' => $value[0]]);
                    $group->title = $value[1];
                    $group->content = $value[2];
                    $group->save();
                }

                if ($value[3]) {
                    $product = new Product();
                    if ($value[4]) {
                        $find_group = Group::where('group_name', $value[4])->first();
                        if ($find_group) {
                            $product->group_ID = $find_group->id;
                        } else {
                            $new_group = new Group();
                            $new_group->group_name = $value[4];
                            $new_group->save();
                            $product->group_ID = $new_group->id;
                        }
                    } else {
                        $new_group = new Group();
                        $new_group->group_name = 'Group_'.$value[3];
                        $new_group->save();
                        $product->group_ID = $new_group->id;
                    }
                    $product->name = $value[3];
                    $product->description = $value[5];
                    $product->save();
                }
            }
            return back()->with('success', 'Excel Data Imported successfully.');
        }
    }
}


// $group = Group::firstOrNew(['group_name' => $row['Group_Name']]);
// $group->title = $row['Title'];
// $group->content = $row['Content'];
// $group->save();

// $product = new Product();
// $find_group = Group::where('group_name', $row['Product_Group_Name'])->first();
// if($find_group)
// {
//     $product->group_ID = $find_group->id;
// }
// else
// {
//     $new_group = new Group();
//     $new_group->group_name = $row['Product_Group_Name'];
//     $new_group->save();
//     $product->group_ID = $new_group->id;
// }
// $product->name = $row['name'];
// $product->description = $row['description'];
// $product->save();