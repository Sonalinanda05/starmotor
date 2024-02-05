<div id="sidenavbar" class="sidebar" style="height:47rem;overflow-y:scroll">
    <div class="logo">
        <img src="{{ asset('backend/assets/images/logo.png') }}" alt>
    </div>
    <!-- <p class="logo"><span>Star</span>Motors</p> -->
    <a href="{{ route('admin.dashboard') }}" class="icon-a"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;Dashboard</a>
    <a href="{{ route('admin.users.view') }}" class="icon-a"><i class="fa fa-users icons"></i>&nbsp;&nbsp;User</a>
    <a href="{{ route('admin.car.view') }}" class="icon-a"><i class="fa fa-car icons"></i>&nbsp;&nbsp;All
        Cars for Sale</a>
    <a href="{{ route('admin.banner.view') }}" class="icon-a"><i class="fas fa-flag"></i>&nbsp;&nbsp;Homepage Banner</a>
    {{-- <a href="{{ route('admin.blog.view') }}" class="icon-a"><i class="fa-solid fa-blog"></i>&nbsp;&nbsp;Blogs</a> --}}
    {{-- <a href="" class="icon-a"><i class="fa fa-car-side icons"></i>&nbsp;&nbsp;Buy Cars</a> --}}
    <a href="{{ route('admin.bookCar.view') }}" class="icon-a"><i class="fa fa-key icons"></i>&nbsp;&nbsp;Booked
        For Test Drive</a>
    <a href="{{ route('admin.contact.view') }}" class="icon-a"><i class="fas fa-phone"></i>&nbsp;&nbsp;Contact Us</a>

    <a href="{{ route('admin.sell.view') }}" class="icon-a"><i class="fas fa-phone"></i>&nbsp;&nbsp;Enquiries for Sell</a>
    <a href="{{ route('admin.profile.edit') }}" class="icon-a"><i class="fa-solid fa-gear"></i>&nbsp;&nbsp;Profile
        Setting</a>
</div>
