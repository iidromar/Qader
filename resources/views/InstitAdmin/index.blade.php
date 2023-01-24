@extends('layouts.InstitAdminLayouts')

@can('isInstitAdmin')
@section('styles')

<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,500,500i,600,700&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="{{ asset('InstitAdmin/css/studiare-assets.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('InstitAdmin/css/style.css') }}">



@endsection
@section('content')

<div class="row">
              <div class="col-lg-12 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">All courses</h4>

                    @if(Session::has('alert-success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success!</strong>{{Session::get('alert-class', 'Course Created Successfully') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> @endif

                   
               


                  @if(Session::has('delete-course'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success!</strong>{{Session::get('alert-class', 'Course Deleted Successfully') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> @endif



                  
                    @if( $courses->count()>0)
                    <table class="table table-bordered" style="color:black;text-align:center;">
                      <thead>
                        <tr class="thead-dark">
                       
                          <th> Title </th>
                          <th> Description </th>
                          <th> Category </th>
                          <th> Course date </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($courses as $course)
                        <tr  style="color:black">                    
                          <td>  {{Str::limit($course->name,10)}} </td>
                          <td class="td"> {{Str::limit($course->description,15)}} </td>
                          <td> {{$course->category}} </td>
                          <td> {{date('d-M-y' , strtotime($course->course_date))}}</td>
                          
                          <td id="outer">
                          <a class='btn btn-sm btn-primary inner' href="{{route('Instit.show' , $course->id)}}"><img width="24" height="24" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEGElEQVR4nO2bW4hNURjHz4xQcmueXEoxDCKlXPKg8DYp1zyJiOFF5BbDPEwpl8FgJkxOSpKkkDFuyWVyyS3lSXIp13JXyG3Gj9Veh89qj87eZ+1tnTPnX6fTOXvt7/99/7X2Ouv71jqJRB555BEEQGegArgJfCReKL47QAMwH+iWiBPASOA57uAzsBEoiiP4AcB73MRjYGjUApwThG+AOUD3SEn/cFcK7qQe/lcNET4BY6NyYKAg+g4Mj4QoPQEqxfdTgFfi2mugOAoH5gmSeusEIQXQ1/oCT8T1S1E4UCEI1lonyJBfPf/AV9FmYmw9EAeAMsF/rIU2G0Sbs7kmwEBjDhrh06a7vpZqU5QzAiioXhU+vAXmAj0SAsAV0WZ8IscE6A+8I32U5ZQACmroA8/SFGBlItcEUAA6AeXAdeCDT+A/gNtqxCRyUYD/AvICkB8B5B8B9+cAoAR4CDwA+rW6EQCsEn6Wt0YBKiPxk6iUzSIBSoD7+hXo2QLaqMREvVtzyOWRChQDS4ELuoDapB1q0p/PA0uAPjklAF7R9CDBcAYYktUC4A3xjaKnTTTpImpL11Xuvt7GIxK7AEAX4KRPwIeBGUBPoFC3LdSfZwJHfAQ5ruxljQBAe+CyEcQJYFCa9w8GThn3XwTaZYsASSMFVcO4IKCNAmAF0Cxs7XFeAGCa0XMLMrS30LA3xVkBgLbAPUFUZ8nubmHzruJxVYA5guSl2i22ZLer3tlJYbarApwWJEss214mbJ90TgC8n73UDkyz7c1RVebWE6rCl6CjKw4BxgmCa9YJPI4bgmOMawLMEAR7rRN4HPsEx3TXBFguCKqsE3gcVYJjuWsCLBUEW6wTeBxbBcci1wSYKQgOWCfwOGRGOc01AUYLgjvWCTwOtQhKYZRrArQzjsYNsGx/kLD9PmhiFNdCqEGQbLJsu1rY3h/i/lgEKDXO6fWyZLe3XvykUOqqAAV69zWFc2ESF58Eq1HYvOB6OjzSqOjsSlV+QtgqNDLBprDH8OIuiDTyN46qvfsQ547rDTuLM/ApthGwGX880muFwjR6fZY+4iqRzNCvWOaAasPpWy0IUQNMAoapPQD9Phmo9QlcZYBrgpbUYhUAb/LbYjhep7+fALwgHJ4CU13fGisw1ui/gzdqBeUBhFDtVgMdLPppXwC84Lf9K3if1eJYYJ2u9d/S+/XX9US5QS+pre8VWhcA/+CTYX/yooZVAfCCr0m3512AOkgtfK3INPjabAreJ0+Za7Pnk64O+3+sTkvCBr89m3peV5LnGeeIz4QNfkdcweva3zfs413g3scLfmecPd/COd9M8SRwIoUXfF2cwWve9cbfXMLig15jqEVYx0xPgDn/zFsH3mmO1hl84s8/MQ7pIdS6gv8lwE8Uh+Q+ZbVZBwAAAABJRU5ErkJggg=="></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <br>
                    {{$courses->links()}}
                    @else
                    <h1>No Course found.</h1>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>



@endsection
@endcan
