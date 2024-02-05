<div class="head">
    <div class="col-div-6">
        <span style="font-size: 30px;cursor:pointer;color:white;" class="nav">&#9776; Star Motors</span>
        <span style="font-size: 30px;cursor:pointer;color:white;" class="nav2">&#9776; Star Motors</span>
    </div>
    <div class="col-div-6">


        
            
       

        <div class="profile">
            <img src="{{ asset('backend/assets/images/bussiness-man.png') }}" class="pro-img" alt>
            <p>Aditya Sahoo <span><a class="dropdown-item text-light" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();" style="color: white">
                 (LogOut)
             </a>
 
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
             </form></span></p>
        </div>
    </div>
    <div class="clearfix"></div>
</div>