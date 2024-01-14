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


    public function editCategory($id)
    {
        $category = FaqCategory::findOrFail($id);
        return view('faq.edit-category', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $category = FaqCategory::findOrFail($id);

        $category->update([
            'name' => $request->input('categoryName'),
        ]);

        return redirect()->route('faq.index')->with('success', 'Category updated successfully.');
    }

    public function destroyCategory($id)
    {
        $category = FaqCategory::findOrFail($id);

        // Delete associated questions
        $category->faqs()->delete();

        // Now, delete the category
        $category->delete();

        return redirect()->route('faq.index')->with('success', 'Category deleted successfully.');
    }

    
    public function createQuestion($categoryId)
    {
        $question = FaqQuestion::findOrFail($id);
        return view('faq.edit-question', compact('question'));
    }

    public function editQuestion($id)
    {
        $question = FaqQuestion::findOrFail($id);
        return view('faq.edit-question', compact('question'));
    }

    public function updateQuestion(Request $request, $id)
    {
        $question = FaqQuestion::findOrFail($id);

        $question->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ]);

        return redirect()->route('faq.index')->with('success', 'Question updated successfully.');
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

    public function destroyQuestion($id)
    {
        $question = FaqQuestion::findOrFail($id);
        $question->delete();

        return redirect()->route('faq.index')->with('success', 'Category deleted successfully.');
    }


}
