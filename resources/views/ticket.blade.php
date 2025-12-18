
<x-layouts.app>

<div class="min-h-screen mb-6 mt-[-50px] flex items-center justify-center">
    <div class="flex flex-col items-center w-full">
        <h1>Customer Feedback Form</h1>
        <form class="max-w-md mb-10 w-full" enctype="multipart/form-data" action="{{ route('tickets.store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="mb-4">
                <x-forms.input label="Name" name="customer[name]" type="text"/>
            </div>

            <div class="mb-4">
                <x-forms.input label="E-mail" name="customer[email]" type="email"/>
            </div>

            <div class="mb-4">
                <x-forms.input label="Phone Number" name="customer[phone_number]" type="text"/>
            </div>

            <div class="mb-4">
                <x-forms.input label="Document" name="customer[file]" type="file"/>
            </div>

            <div class="mb-4">
                <x-forms.input label="Subject" name="subject" type="text"/>
            </div>

            <div class="mb-6">
                <x-forms.textarea label="Description" name="description" rows="6"/>
            </div>

            <div>
                <x-button type="primary">{{ __('Send Ticket') }}</x-button>
            </div>
        </form>
    </div>
</div>

@if (isset($success))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: "{{ $success }}",
            confirmButtonText: 'Fechar',
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif

</x-layouts.app>