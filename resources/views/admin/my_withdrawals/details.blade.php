<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Withdrawal Informations') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">
                <h3 class="mb-5 text-3xl font-bold text-indigo-950">My Request</h3>
                <div class="flex flex-row gap-x-16">
                    <svg width="100" height="100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M19 10.2798V17.4298C18.97 20.2798 18.19 20.9998 15.22 20.9998H5.78003C2.76003 20.9998 2 20.2498 2 17.2698V10.2798C2 7.5798 2.63 6.7098 5 6.5698C5.24 6.5598 5.50003 6.5498 5.78003 6.5498H15.22C18.24 6.5498 19 7.2998 19 10.2798Z" fill="#292D32"/>
                        <path d="M22 6.73V13.72C22 16.42 21.37 17.29 19 17.43V10.28C19 7.3 18.24 6.55 15.22 6.55H5.78003C5.50003 6.55 5.24 6.56 5 6.57C5.03 3.72 5.81003 3 8.78003 3H18.22C21.24 3 22 3.75 22 6.73Z" fill="#292D32"/>
                        <path d="M6.96027 18.5601H5.24023C4.83023 18.5601 4.49023 18.2201 4.49023 17.8101C4.49023 17.4001 4.83023 17.0601 5.24023 17.0601H6.96027C7.37027 17.0601 7.71027 17.4001 7.71027 17.8101C7.71027 18.2201 7.38027 18.5601 6.96027 18.5601Z" fill="#292D32"/>
                        <path d="M12.5494 18.5601H9.10938C8.69938 18.5601 8.35938 18.2201 8.35938 17.8101C8.35938 17.4001 8.69938 17.0601 9.10938 17.0601H12.5494C12.9594 17.0601 13.2994 17.4001 13.2994 17.8101C13.2994 18.2201 12.9694 18.5601 12.5494 18.5601Z" fill="#292D32"/>
                        <path d="M19 11.8599H2V13.3599H19V11.8599Z" fill="#292D32"/>
                        </svg>
                    <div class="flex flex-col gap-y-10">    
                        <div>
                            <p class="text-sm text-slate-500">Total Amount</p>
                            <h3 class="text-xl font-bold text-indigo-950">Rp {{ number_format($fundraisingWithdrawal->amount_requested, 0, ',', '.') }}</h3>
                        </div>

                        @if ($fundraisingWithdrawal->has_sent)
                            @if ($fundraisingWithdrawal->has_received)
                                <span class="px-3 py-2 text-sm font-bold text-white bg-green-500 rounded-full w-fit">
                                    DELIVERED
                                </span>
                            @else
                                <span class="px-3 py-2 text-sm font-bold text-white bg-indigo-500 rounded-full w-fit">
                                    PROCCESSED
                                </span>
                            @endif
                        @else 
                            <span class="px-3 py-2 text-sm font-bold text-white bg-orange-500 rounded-full w-fit">
                                PENDING
                            </span>
                        @endif    
                            
                            <div>
                                <p class="text-sm text-slate-500">Date</p>
                                <h3 class="text-xl font-bold text-indigo-950">{{ $fundraisingWithdrawal->created_at->format('M d, Y') }}</h3>
                            </div>
                    </div>
                    <div>
                        <img src="{{ Storage::url($fundraisingWithdrawal->fundraising->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[300px] h-[200px] mb-3">
                        <h3 class="text-xl font-bold text-indigo-950">{{ $fundraisingWithdrawal->fundraising->name }}</h3>
                        <p class="text-sm text-slate-500">{{ $fundraisingWithdrawal->fundraising->category->name }}</p>
                    </div>
                </div>
                <hr class="my-5">

                @if ($fundraisingWithdrawal->has_sent)
                <h3 class="mb-5 text-xl font-bold text-indigo-950">Sent to:</h3>
                <div class="flex flex-row gap-x-10">    
                    <div>
                        <p class="text-sm text-slate-500">Bank</p>
                        <h3 class="text-xl font-bold text-indigo-950">{{ $fundraisingWithdrawal->bank_name }}</h3>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">No Account</p>
                        <h3 class="text-xl font-bold text-indigo-950">{{ $fundraisingWithdrawal->bank_account_number }}</h3>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Account Name</p>
                        <h3 class="text-xl font-bold text-indigo-950">{{ $fundraisingWithdrawal->bank_account_name }}</h3>
                    </div>
                    {{--  <div>
                        <p class="text-sm text-slate-500">SWIFT Code</p>
                        <h3 class="text-xl font-bold text-indigo-950">ANCAP</h3>
                    </div>  --}}
                </div>
                <hr class="my-5">

                
                    <h3 class="mb-5 text-xl font-bold text-indigo-950">Uang Sudah di Transfer:</h3>
                    <img src="{{ Storage::url($fundraisingWithdrawal->proof) }}" alt="" class="rounded-2xl object-cover w-[300px] h-[200px] mb-3">
                    <hr class="my-5">
                    <h3 class="text-xl font-bold text-indigo-950">Have You Delivered Money?</h3>
                    <form action="{{ route('admin.fundraising_withdrawals.store', $fundraisingWithdrawal->fundraising_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{--  @method('PUT')  --}}
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="notes" :value="__('notes')" />
                            <textarea name="notes" id="notes" cols="30" rows="5" class="w-full border border-slate-300 rounded-xl"></textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>
                        <div class="mt-4 w-fit">
                            <x-input-label for="photo" :value="__('photo')" />
                            <x-text-input id="photo" class="block w-full mt-1 mb-7" type="file" name="photo" required autofocus autocomplete="photo" />
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>
                        <button type="submit" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Update Donation
                        </button>
                    </form>
                @endif
                
            </div>
            
        </div>
    </div>
</x-app-layout>
