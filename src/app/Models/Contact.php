<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (empty($keyword)) {
            return $query;
        }

        return $query->where(function ($q) use ($keyword) {
            $q->where('last_name', 'like', "%{$keyword}%")
            ->orWhere('first_name', 'like', "%{$keyword}%")
            ->orWhereRaw(
                "CONCAT(last_name, first_name) LIKE ?",
                ["%{$keyword}%"]
            )
            ->orWhere('email', 'like', "%{$keyword}%");
        });
    }


    public function scopeGenderSearch($query, $gender)
    {
        // 未選択 or 全て(0) → 条件を付けない
        if (empty($gender) || $gender == 0) {
        return $query;
        }

        return $query->where('gender', $gender);
    }

    public function scopeCategorySearch($query, $categoryId)
    {
        if (empty($categoryId)) {
            return $query;
        }

        return $query->where('category_id', $categoryId);
    }

    public function scopeDateSearch($query, $date)
    {
        if (empty($date)) {
            return $query;
        }

        return $query->whereDate('created_at', $date);
    }



    

}
