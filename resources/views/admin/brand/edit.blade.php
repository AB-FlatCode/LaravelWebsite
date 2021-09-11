<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      All Brands
      </h2>
  </x-slot>

  <div class="py-12">
     <div class="container">
       <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-header">Edit Brand</div>
            <div class="card-body">
            <form action="{{ route('update.brand', $brand->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <input type="hidden" name="old_img"  value="{{ $brand->brand_img }}">
              <div class="form-group">
                <label for="exampleInputEmail1">Update Brand Name</label>
                <input type="text" name="brand_name" class="form-control" value="{{ $brand->brand_name }}" id="exampleInputEmail1" aria-describedby="emailHelp">

                @error('brand_name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
           
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1"> Update Brand Image</label>
                <input type="file" name="brand_img" class="form-control" value="{{ $brand->brand_img }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('brand_img')
                  <span class="text-danger">{{ $message }}</span>
                @enderror         
              </div>
              <div class="form-group">
                <img style="width: 150px" height="auto" src="{{ asset($brand->brand_img) }}" alt="">
              </div>
              <button type="submit" class="btn btn-primary">Update Brand</button>
            </form>
          </div>
          </div>
        </div>    
      </div>
     </div>
  </div>
</x-app-layout>
