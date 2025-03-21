<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Services\QuoteService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class QuoteController extends Controller
{
    protected QuoteService $quoteService;

    // Inject the QuoteService into the controller using auth:sanctum middleware

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
        $this->middleware('auth:sanctum')->except(['random']);
    }

    // Method to retrieve a random quote

    public function random(): JsonResponse
    {
        try {
            $quote = $this->quoteService->getRandomQuote();
            return response()->json($quote);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve a random quote',
                'message' => $e->getMessage(),
                'status' => 503 // Service Unavailable
            ], 503);
        }
    }

    // Method to retrieve all quotes

    public function index(Request $request): JsonResponse
    {
        $quotes = $request->user()->quotes()->paginate(10);

        return response()->json($quotes);
    }

    // Method to save a quote

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'content' => 'required|string',
                'author' => 'nullable|string|max:255',
            ]);

            $quote = $request->user()->quotes()->create($validated);

            return response()->json([
                'message' => 'Quote saved successfully',
                'quote' => $quote,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    // Method to delete a saved quote

    public function destroy(Quote $quote): JsonResponse
    {
        if ($quote->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $quote->delete();

        return response()->json(['message' => 'Quote deleted successfully'], 204);
    }
}
