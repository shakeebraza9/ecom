@extends('admin.layout')
@section('css')
<style>
    .invalid-feedback{
      display: block;
   }
</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">ADD YOUR BRAND
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Brand</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white" >Create Brand</h4>
            </header>
            <div class="card-body">
                <form method="post" action="{{URL::to('admin/brand/store')}}" >
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Title</label>
                                <input required type="text" value="{{old('title')}}" name="title" class="form-control title"
                                placeholder="Title">
                                @if($errors->has('title'))
                                 <p class="invalid-feedback" >{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Slug</label>
                                  <input required type="text" value="{{old('slug')}}" name="slug" class="slug form-control" placeholder="Slug">
                                  @if($errors->has('slug'))
                                  <p class="invalid-feedback" >{{ $errors->first('slug') }}</p>
                                  @endif
                              </div>
                        </div>


                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Image</label>
                                  <input type="text" value="{{old('image')}}" name="image" class="form-control" placeholder="Image">
                                  @if($errors->has('image'))
                                  <p class="invalid-feedback" >{{ $errors->first('image') }}</p>
                                  @endif
                              </div>
                        </div> --}}

                        <div class="col-md-6 file_manager_parent">
                            <div class="form-group">
                                <label class="form-label" >Image</label>
                                <select class="file_manager" name="image_id"
                               placeholder="Select an option"></select>

                                 @if($errors->has('image_id'))
                                 <p class="invalid-feedback" >{{ $errors->first('image_id') }}</p>
                                 @endif
                             </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Meta Title</label>
                                <input placeholder="Meta Title" type="text" value="{{old('meta_title')}}" name="meta_title" class="form-control" />
                                @if($errors->has('meta_title'))
                                 <p class="invalid-feedback" >{{ $errors->first('meta_title') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Meta Description</label>
                                <input type="text" placeholder="Meta Description"
                                value="{{old('meta_description')}}" name="meta_description" class="form-control" />
                                @if($errors->has('meta_description'))
                                 <p class="invalid-feedback" >{{ $errors->first('meta_description') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Meta Keywords</label>
                                <input type="text" placeholder="Meta Keywords"
                                value="{{old('meta_keywords')}}" name="meta_keywords"
                                class="form-control" />
                                @if($errors->has('meta_keywords'))
                                 <p class="invalid-feedback" >{{ $errors->first('meta_keywords') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>














                </form>
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')

<script>


        $(".title").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $(".slug").val(Text);
        });
        $(document).ready(function() {
            var currentUrl = window.location.href;
            $('.perent_Product ul li a').each(function() {

                    console.log('ho');
                    $('.category-link-tag').addClass('active');
                    $(this).closest('ul').addClass('show');

            });
        });

</script>

@endsection
