<?php

/**
 * 添加表注释
 *
 * @param $table
 * @param $comment
 * @return bool
 */
function add_table_comment($table,$comment){
    $sql = "alter table `".env('DB_PREFIX').$table."` comment '{$comment}'";
    Illuminate\Support\Facades\DB::statement($sql);
    return true;
}


if (! function_exists('throwErrorMessage')) {

    /**
     * throwErrorMessage  抛出错误消息
     *
     * @param  string $module   模块
     * @param  string $code     编码
     * @param  string $append   附加信息
     * @return Exception
     */
    function throwErrorMessage(string $module,string $code, $append = ""): \Exception
    {

        $message = Denny071\LaravelApidoc\Helper::getMessage($module,$code);

        $message = $code."|".$message.($append?"(".$append.")":"");

        throw new App\Exceptions\InternalException($message);
    }
}
