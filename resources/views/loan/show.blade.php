@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold mb-4">Loan Details</h2>
                <dl class="grid grid-cols-2 gap-x-4 gap-y-2">
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Loan Amount</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $repository->getLoanAmount() }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Interest Rate (%)</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $repository->getInterestRate() }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Loan Term (years)</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $repository->getLoanTerm() }}</dd>
                    </div>

                </dl>
            </div>
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold mb-4">Amortization Schedule</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Month</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Starting Balance</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monthly Payment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Principal Component</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interest Component</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ending Balance</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($repository->getScheduleList() as $payment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->getMonth() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->getStartingBalance() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->getMonthlyPayment() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->getPrincipalComponent() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->getInterestComponent() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->getEndingBalance() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
