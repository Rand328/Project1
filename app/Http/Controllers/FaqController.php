<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with('faqs')->get();
        return view('faq.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('faq.faq-create');
    }

    public function saveCategory(Request $request)
    {
        $request->validate([
            'categoryName' => 'required|string|max:255',
        ]);

        $category = FaqCategory::create([
            'name' => $request->input('categoryName'),
        ]);

        return redirect()->route('faq.index')->with('success', 'Category created successfully.');
    }

    public function createQuestion($categoryId)
    {
        $category = FaqCategory::findOrFail($categoryId);

        return view('faq.faq-create-question', compact('categoryId'));
    }

    public function saveQuestion(Request $request, $categoryId)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $category = FaqCategory::findOrFail($categoryId);

        $question = new FaqQuestion();
        $question->question = $request->input('question');
        $question->answer = $request->input('answer');
        $question->faq_category_id = $category->id;

        $question->save();

        return redirect()->route('faq.index')->with('success', 'Question added successfully.');
    }
}
