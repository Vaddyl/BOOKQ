<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{$users->name}}'s Profile</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/agency.css')}}" rel="stylesheet">

  </head>
  <body>
    <!-- Navigation -->
    @include('layouts.partial.header')
    <br>
     <!-- Page Content -->
    <div class="container">
      <div class="row"> 
        <div class="center card col-lg-10 pb-2"> 
          <div class="row">
            <div class="col-md-4 mt-4">
                <img class="img-responsive img-user img-center" src="{{asset($users->user_image)}}" alt="">
                <div class="row">
                
                </div>
            </div>
            <div class="card-body mt-4 col-md-8">
                <h3 class="card-title">{{$users->name}} <a href="{{url("/profile/{$users->id}/edit")}}" class="btn btn-primary btn-sm">Edit Profile</a></h3> 
                <div class="row">
                    <div class="col-md-6">
                        <table>
                            <tr>
                                @if ( !empty ( $users->nim ) ) 
                                    <td valign="top"> NIM </td> <td valign="top">&nbsp;:&nbsp;</td> <td> {{$users->nim}} </td>
                                
                                @else
                                    <td valign="top"> NIM </td> <td valign="top">&nbsp;:&nbsp;</td> <td> - </td>
                                @endif
                            </tr>
                            <tr>
                                @if ( !empty ( $users->address ) ) 
                                    <td valign="top"> Address </td> <td valign="top">&nbsp;:&nbsp;</td> <td> {{$users->address}} </td>
                                @else
                                    <td valign="top"> Address </td> <td valign="top">&nbsp;:&nbsp;</td> <td> - </td>
                                @endif
                            </tr> 
                            <tr>
                                @if ( !empty ($users->line_id) )
                                    <td valign="top"> Line ID </td> <td valign="top">&nbsp;:&nbsp;</td> <td> {{$users->line_id}} </td>
                                @else
                                    <td valign="top"> Line ID </td> <td valign="top">&nbsp;:&nbsp;</td> <td> - </td>
                                @endif
                            </tr> 
                            <tr>
                                @if ( !empty ($users->phone_number) )
                                        <td valign="top"> Phone No. </td> <td valign="top">&nbsp;:&nbsp;</td> <td> {{$users->phone_number}} </td>
                                @else
                                    <td valign="top"> Phone No. </td> <td valign="top">&nbsp;:&nbsp;</td> <td> - </td>
                                @endif
                            </tr>
                            <tr>
                                <td valign="top"> Interest </td> <td valign="top">&nbsp;:&nbsp;</td> <td> {{$users->fav_book}} </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
                <div class="row"> 
                    <div class="col-1"></div>
                    <div class="col"> <br>
                        <h4 class="card-title">About Me</h4>
                        <p class="card-text">{{ $users->about_me }}</p>
                    </div>
                </div>
             </div>
         </div> <br>
            </div>
          </div>
        </div>
        <br>
          <!-- /.card -->
          <div class="row">
            <div class="card col-9 center pb-2">
                <ul class="nav nav-tabs" id="userTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="true">Recent Activities(history)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="borrow-tab" data-toggle="tab" href="#borrow" role="tab" aria-controls="borrow" aria-selected="false">Borrow</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="lend-tab" data-toggle="tab" href="#lend" role="tab" aria-controls="lend" aria-selected="false">Lend</a>
                    </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="history" role="tabpanel" aria-labelledby="history-tab">
                        <div class="card-body">
                            @foreach($activities->all() as $activity)
                                @if($activity->status==0)
                                <p><small class="text-muted">{{ $activity->request_date }} </small>Sent request to {{App\User::find($activity->id_lender)->name}} to borrow {{ App\Book::find($activity->book_id)->title }}</p>
                                @endif
                                @if($activity->status==1)
                                <p><small class="text-muted">{{ $activity->lend_date }} </small>{{App\User::find($activity->id_lender)->name}} accepted your request for borrowing "{{ App\Book::find($activity->book_id)->title }}"!</p>
                                @endif
                                @if($activity->status==2)
                                <p><small class="text-muted">{{ $activity->return_date }} </small>You have returned {{App\User::find($activity->id_lender)->name}}'s "{{ App\Book::find($activity->book_id)->title }}" book</p>
                                @endif
                                @endforeach
                        </div>    
                    </div>
                    <div class="tab-pane fade" id="borrow" role="tabpanel" aria-labelledby="borrow-tab">
                        <div class="card-body">
                                @foreach($requests_borrow->all() as $request_b)
                                @if($request_b->status==0)
                                <p><small class="text-muted">{{ $request_b->request_date }} </small>Sent request to {{App\User::find($request_b->id_lender)->name}} to borrow {{ App\Book::find($request_b->book_id)->title }}</p>
                                @endif
                                @if($request_b->status==1)
                                <p><small class="text-muted">{{ $request_b->lend_date }} </small>{{App\User::find($request_b->id_lender)->name}} accepted your request for borrowing "{{ App\Book::find($request_b->book_id)->title }}"!</p>
                                @endif
                                @if($request_b->status==2)
                                <p><small class="text-muted">{{ $request_b->return_date }} </small>You have returned {{App\User::find($request_b->id_lender)->name}}'s "{{ App\Book::find($request_b->book_id)->title }}" book</p>
                                @endif
                                @if($request_b->status==3)
                                <p><small class="text-muted">{{ $request_b->reject_date }} </small>{{App\User::find($request_b->id_lender)->name}} have declined Your request for "{{ App\Book::find($request_b->book_id)->title }}"</p>
                                @endif
                                
                                @endforeach
                        </div>    
                    </div>
                    <div class="tab-pane fade" id="lend" role="tabpanel" aria-labelledby="lend-tab">
                        <div class="card-body">
                                @foreach($requests_lend->all() as $request_l)
                                @if($request_l->status==0)
                                    <p><small class="text-muted">{{ $request_l->request_date }} </small>{{App\User::find($request_l->id_booker)->name}} wants to borrow "{{ App\Book::find($request_l->book_id)->title }}"</p>
                                    <a href='{{ url("/accept/{$request_l->id}") }}' class="btn btn-primary">Accept</a>
                                    <a href='{{ url("/reject/{$request_l->id}") }}' class="btn btn-primary">Decline</a>
                                @endif
                                @if($request_l->status==1)
                                <p><small class="text-muted">{{ $request_l->lend_date }} </small>You lended "{{ App\Book::find($request_l->book_id)->title }}" to {{App\User::find($request_l->id_booker)->name}}</p>
                                <a href='{{ url("/return/{$request_l->id}") }}' class="btn btn-primary">I have Recieved my Book back</a>
                                @endif
                                @if($request_l->status==2)
                                <p><small class="text-muted">{{ $request_l->return_date }} </small>{{App\User::find($request_l->id_booker)->name}} have returned your "{{ App\Book::find($request_l->book_id)->title }}"</p>
                                @endif
                                @if($request_l->status==3)
                                <p><small class="text-muted">{{ $request_l->reject_date }} </small>You have declined {{App\User::find($request_l->id_booker)->name}}'s request for "{{ App\Book::find($request_l->book_id)->title }}"</p>
                                @endif
                                @endforeach
                                
                            <hr>
                        </div>    
                    </div>
                    </div>
        </div>
    </div>
          <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

      </div>

    </div>
    <!-- /.container -->


    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery_search/jquery.min.js"></script>
    <script src="../vendor/bootstrap_search/js/bootstrap.bundle.min.js"></script>

  </body>

</html>