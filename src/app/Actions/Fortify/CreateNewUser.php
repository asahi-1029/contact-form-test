<?php
namespace App\Actions\Fortify;

use App\Models\User;
use App\Http\Requests\UserRequest; // ご提示のリクエストクラス
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    /**
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input): User
    {
        // 1. フォームリクエストをサービスコンテナから解決
        $request = app(UserRequest::class);

        // 2. バリデーションを実行 (失敗すればここで例外が飛び、以降は実行されません)
        $request->validateResolved();

        // 3. バリデーション済みデータを取得
        $validated = $request->validated();

        // 4. ハッシュ化してデータベースに保存
        return User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']), // ここでハッシュ化！
        ]);
    }

}