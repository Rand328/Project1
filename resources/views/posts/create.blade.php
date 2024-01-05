<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add post') }}
        </h2>
    </x-slot>
  <section class="mt-3">
    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    <!--csrf protects your form from cross-site attacks-->  
    @csrf
      <!-- Error message when data is not inputted -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="card p-3">
        <label for="floatingInput">Title</label>
        <br>
        <input id="image" wire:model="image" accept="image/*" class="form-control" type="text" name="title">
        <br>
        <label for="floatingTextArea">Description</label>
        <br>
        <textarea class="form-control" name="description" id="floatingTextarea" cols="30" rows="10"></textarea>
        <br>
        <label for="formFile" class="form-label">Add Image</label>
        <img src="" alt="" class="img-blog">
        <input class="form-control" type="file" name="image" id="image" wire:model="image" accept="image/*">
      </div>
      <button class="btn btn-secondary m-3">Save</button>
    </form>
  </section>
    
</div>
</x-app-layout>

<!--code overgenomen van https://kinsta.com/blog/laravel-blog/ -->