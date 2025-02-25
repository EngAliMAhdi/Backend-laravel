<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Quran;
use Illuminate\Http\Request;

class QuranController extends Controller
{
    public function countCharsBetweenVerses($chapter, $startVerse, $endVerse) {
        // جلب الآيات بين الرقمين المحددين
        $verses = Quran::where('chapter', $chapter)
            ->whereBetween('verse', [$startVerse, $endVerse])
            ->get();
    
        // حساب مجموع عدد الأحرف
        $totalChars = $verses->sum('char_count');
    
        return response()->json([
            'chapter' => $chapter,
            'start_verse' => $startVerse,
            'end_verse' => $endVerse,
            'total_characters' => $totalChars
        ]);
    }
    public function getSurah($chapter) {
        $verses = Quran::where('chapter', $chapter)->get();
        return response()->json($verses);
    }

    // استرجاع آية معينة من سورة معينة
    public function getVerse($chapter, $verse) {
        $ayah = Quran::where('chapter', $chapter)->where('verse', $verse)->first();
        return response()->json($ayah);
    }
}
