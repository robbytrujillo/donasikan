<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Fundraising Details') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">

                @if ($fundraising->is_active)
                     <span class="p-5 font-bold text-white bg-green-500 w-fit rounded-2xl">
                        Fundraising telah aktif dan dapat menerima donasi.
                    </span>
                @else
                    <div class="flex flex-row justify-between">
                        <span class="p-5 font-bold text-white bg-red-500 w-fit rounded-2xl">
                            Fundraising belum disetujui oleh Admin.
                        </span>
                        @role('owner')
                            <form action="{{ route('admin.fundraising_withdrawals.activate_fundraising', $fundraising) }}" method="POST">
                                @csrf
                                
                                <button type="submit" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                                    Approve Now
                                </button>
                            </form>
                        @endrole
                    </div>
                @endif
                <hr>

                <div class="flex flex-row items-center justify-between item-card gap-y-10">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($fundraising->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[200px] h-[150px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">{{ $fundraising->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $fundraising->category->name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm text-slate-500">Donaturs</p>
                        <h3 class="text-xl font-bold text-indigo-950">{{ $fundraising->donaturs->count() }}</h3>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.fundraisings.edit', $fundraising) }}" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('admin.fundraisings.destroy', $fundraising) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-4 font-bold text-white bg-red-700 rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-5">
                <div class="flex flex-row items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-indigo-950">Rp {{ number_format($totalDonations, 0, ',', '.') }}</h3>
                        <p class="text-sm text-slate-500">Funded</p>
                    </div>
                    <div class="w-[400px] rounded-full h-2.5 bg-slate-300">
                        <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-indigo-950">Rp {{ number_format($fundraising->target_amount, 0, ',', '.') }}</h3>
                        <p class="text-sm text-slate-500">Goal</p>
                    </div>
                </div>
                
                @if ($goalReached)
                    <hr class="my-5">
                    <h3 class="text-2xl font-bold text-indigo-950">Withdraw Donations</h3>

                    <form method="POST" action="#" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="bank_name" :value="__('bank_name')" />
                            <x-text-input id="bank_name" class="block w-full mt-1" type="text" name="bank_name" :value="old('bank_name')" required autofocus autocomplete="bank_name" />
                            <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="bank_account_name" :value="__('bank_account_name')" />
                            <x-text-input id="bank_account_name" class="block w-full mt-1" type="text" name="bank_account_name" :value="old('bank_account_name')" required autofocus autocomplete="bank_account_name" />
                            <x-input-error :messages="$errors->get('bank_account_name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="bank_account_number" :value="__('bank_account_number')" />
                            <x-text-input id="bank_account_number" class="block w-full mt-1" type="text" name="bank_account_number" :value="old('bank_account_number')" required autofocus autocomplete="bank_account_number" />
                            <x-input-error :messages="$errors->get('bank_account_number')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                
                            <button type="submit" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                                Request Withdraw
                            </button>
                        </div>
                    </form>
                @endif

                <hr class="my-5">

                <div class="flex flex-row items-center justify-between">
                    <div class="flex flex-col">
                        <h3 class="text-xl font-bold text-indigo-950">Donaturs</h3>
                    </div>
                </div>

                {{--  @for($i = 0; $i < 5; $i++)  --}}
                @forelse($fundraising->donaturs as $donatur)
                <div class="flex flex-row items-center justify-between item-card gap-y-10">
                    <div class="flex flex-row items-center gap-x-3">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">Rp {{ number_format($donatur->total_amount, 0, ',', '.') }}</h3>
                            <p class="text-sm text-slate-500">{{ $donatur->name }}</p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-500">{{ $donatur->notes }}</p>
                    
                </div>
                @empty
                    <p><i>Belum ada yang memberikan donasi</i></p>
                @endforelse
                
            </div>
        </div>
    </div>
</x-app-layout>
