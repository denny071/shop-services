<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Resource;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageList = [
            "https://img.alicdn.com/bao/uploaded/i2/TB1iqkaLVXXXXagXXXXObG1FpXX_091208.jpg_b.jpg",
            "https://img.alicdn.com/bao/uploaded/i4/TB1URYGHVXXXXXsaXXXtD198VXX_032444.jpg_b.jpg",
            "https://img.alicdn.com/bao/uploaded/i5/TB1up8DGXXXXXaAaXXXszso_pXX_060025.jpg_b.jpg",
            "https://img.alicdn.com/bao/uploaded/i3/TB1oIQJKVXXXXc3XXXXa0s37FXX_013328.jpg_b.jpg",
            "https://img.alicdn.com/bao/uploaded/i2/TB1SynxMVXXXXaVXFXX_qyp.VXX_111729.jpg_b.jpg",
            "https://img.alicdn.com/bao/uploaded/i8/TB1nkDwATJYBeNjy1zelIqhzVXa_020604.jpg_b.jpg",
            "https://img.alicdn.com/bao/uploaded/i2/TB1iqkaLVXXXXagXXXXObG1FpXX_091208.jpg_b.jpg",
            "https://img.alicdn.com/bao/uploaded/i4/TB1URYGHVXXXXXsaXXXtD198VXX_032444.jpg_b.jpg",
            "https://img.alicdn.com/bao/uploaded/i5/TB1up8DGXXXXXaAaXXXszso_pXX_060025.jpg_b.jpg",
            "https://img.alicdn.com/bao/uploaded/i3/TB1oIQJKVXXXXc3XXXXa0s37FXX_013328.jpg_b.jpg",
        ];

        foreach ($imageList as $value) {
            $resource = new Resource;
            $resource->type = "image";
            $resource->http_url = $value;
            $resource->base_url = "";
            $resource->storage_path = "";
            $resource->save();
        }
    }
}
