@extends('layouts.app')
@section('content')
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Create Loan
            </h2>

            <div class="mt-8 bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-8 sm:px-10 sm:py-8">
                    <form method="POST" action="{{ route('loan.store') }}">
                        @csrf
                        <div>
                            <label for="loan_amount" class="block text-sm font-medium text-gray-700">Loan Amount</label>
                            <input type="number" name="loan_amount" id="loan_amount" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('loan_amount') border-red-500 @enderror" value="{{ old('loan_amount') }}" required autofocus>
                            @error('loan_amount')
                            <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="interest_rate" class="block text-sm font-medium text-gray-700">Interest Rate (%)</label>
                            <input type="number" name="interest_rate" id="interest_rate" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('interest_rate') border-red-500 @enderror" value="{{ old('interest_rate') }}" required>
                            @error('interest_rate')
                            <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="loan_term" class="block text-sm font-medium text-gray-700">Loan Term (years)</label>
                            <input type="number" name="loan_term" id="loan_term" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 @error('loan_term') border-red-500 @enderror" value="{{ old('loan_term') }}" required>
                            @error('loan_term')
                            <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Add more fields for extra repayments, loan start date, etc. -->

                        <div class="mt-6">
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Create Loan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
