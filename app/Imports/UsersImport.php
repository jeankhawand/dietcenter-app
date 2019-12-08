<?php

namespace App\Imports;

use App\Ingredient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements  ToModel,ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ingredient([
            //
        ]);
    }
    public function collection(Collection $rows)
    {
        $val = DB::table('Ingredient')->count();
        if ($val == 0) {

            if ($val->count() > 0) {
                foreach ($rows->toArray() as $key => $value) {
                    foreach ($value as $row) {
                        $insert_data[] = array(
                            'name'  => $row['Food Name'],
                            'protein'   => $row['Protein (g)'],
                            'fat'   => $row['Fat (g)'],
                            'calories'    => $row['Calories'],
                            'sugar'  => $row['Sugar (g)'],
                            'fiber'   => $row['Fiber (g)'],
                            'calcium'   => $row['Calcium (mg)'],
                            'iron'   => $row['Iron (mg)'],
                            'magnesium'   => $row['Magnesium (mg)']
                        );
                    }
                }

                if (!empty($insert_data)) {
                    DB::table('Ingredient')->insert($insert_data);
                }
            }
            error_log('Excel Data Imported successfully.');
        }
        error_log('Excel Data Already Imported');
    }
}
