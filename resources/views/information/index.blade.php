@extends('layouts.master')
@section('content')
<main class="app-content">
    <div style="padding: 1.5rem; border: 1px solid white;background: white">
        <h4>User Information - &nbsp{{ucwords($info->emp_name)}}</h4>
        <div class="container-fluid">
        	@if($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					{{$message}}
				</div>
			@endif
            <div class="row">
                <div class=" col-md-8"><br><br>
                    {{-- <div class="row mb-4">
                        <div class="col-md">
                            <form method="GET" action="{{route('information.edit', $info->user_id)}}">
                                <input type="submit" class="btn btn-info btn-sm " value="Update Info">
                            </form>
                        </div>
                        <p class="text-muted"><small>{{!empty($info['department']) ? ucwords($info['department']->name) : ''}}</small></p>
                    </div> --}}
                {{-- <div id="form-area">
                    <div class="row col-12">
                        <div class="col-4">
                            <div class="form-group">
                                <td><button class="btn btn-sm btn-info">UPDATE profile</button></td>
                            </div>
                        </div>
                        
                    </div>
                </div> --}}
                    <div class="row ">
                        <div class="col-6 form-group">
                                <label for=""><b>Full Name - </b></label>
                                <td>{{ucwords($info->emp_name)}}</td>
                        </div>
                        <div class="col-6 form-group">
                                <label for=""><b>Date of Birth - </b></label>
                                <td>{{empty($info->emp_dob) ? '' : $info->emp_dob}}</td>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-6 form-group">
                                <label for=""><b>Gender - </b></label>
                                <td>{{empty($info->emp_gender) ? '' : $info->emp_gender}}</td>
                        </div>
                        <div class="col-6 form-group">
                                <label for=""><b>Contact Number - </b></label>
                                <td>{{ !empty($info->contact) ? $info->contact : ''}}</td>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                                <label for=""><b>Email - </b></label>
                                <td>{{ !empty($info->email) ? $info->email : ''}}</td>
                        </div>
                        <div class="col-6 form-group">
                                <label for=""><b>Current Residence - </b></label>
                                <td>{{ !empty($info->curr_addr) ? $info->curr_addr : ''}}</td>
                        </div>
                    </div>
                </div>
                <div class="col-4 text-center">
                    
                        @if(empty($info->emp_img))
                                <label for="file_path">Profile Image</label>
                                <input type="file" name="file_path" class="form-group-file" id="file_path" value="{{ old('file_path')}}">
                                @error('file_path')
                                <span class="text-danger" role="alert">
                                    <strong>* {{ $message }}</strong>
                                </span>
                                @enderror
                            @else
                            	<form action="{{route('update-avatar')}}" method="post" enctype="multipart/form-data">
                            		@csrf()
                                	<img src="{{asset('storage/'.trim($info->emp_avatar, 'public'))}}" height="180" width="180" class="">
                                	<div class="text-right">
                                		<input type="file" name="file_path" class="form-group-file text-right" id="file_path" value="{{ old('file_path')}}">
                                	</div>
                                	@error('file_path')
						                <span class="text-danger" role="alert">
						                    <strong>{{ $message }}</strong>
						                </span>
						            @enderror
						            <div>
                                		<button type="submit" class="btn btn-sm btn-info">UPDATE</button>
                                	</div>
                            	</form>
                            @endif
                    {{-- {{dd(asset('storage/'.trim($info->emp_avatar, 'public')))}} --}}
                </div>
                    {{-- <div class="col-8 text-center">
                    <img src="{{asset('storage/'.trim($info->emp_avatar, 'public'))}}" height="180" width="180"><br>
                        <input type="file" name="file_path" class="form-group-file" id="file_path" value="{{ old('file_path')}}">
                    </div> --}}
            </div>
        </div>
    </div>
</main>
@endsection
