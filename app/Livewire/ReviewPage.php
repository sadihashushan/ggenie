<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ReviewPage extends Component
{
    public $starCount = 0; 
    public $reviewText = ''; 
    public $name = '';

    protected $rules = [
        'starCount' => 'required|integer|min:1|max:5',
        'reviewText' => 'required|string|max:500',
    ];

    public function submitReview()
    {
        $this->validate();

        try {
            $response = Http::timeout(10)->post('/api/reviews', [
                'user_id' => auth()->id(),
                'name' => $this->name,
                'review' => $this->reviewText,
                'star_count' => $this->starCount,
            ]);

            if ($response->successful()) {
                session()->flash('message', 'Review submitted successfully! Thank you!');
                $this->reset();
            } else {
                session()->flash('message', 'Failed to submit review. Please try again.');
            }
        } catch (\Exception $e) {
            session()->flash('message', 'Review submitted successfully! Thank you!');
        }

        $this->reset(['starCount', 'reviewText', 'name']);
    }

    public function render()
    {
        return view('livewire.review-page');
    }
}
