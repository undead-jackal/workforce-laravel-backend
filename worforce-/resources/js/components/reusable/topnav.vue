<template>
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <i class="fas fa-bars"></i>
        </button>
        <a class="c-header-brand d-lg-none" href="#">
            
        </a>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="c-header-nav d-md-down-none">
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Dashboard</a></li>
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Users</a></li>
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Settings</a></li>
        </ul>
        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item d-md-down-none mx-2">
                <a class="c-header-nav-link" href="#">
                    <i class="fas fa-bell"></i>
                </a>
            </li>
            <li class="c-header-nav-item d-md-down-none mx-2">
                <a class="c-header-nav-link" href="#">
                    <i class="fas fa-tasks"></i>
                </a>
            </li>
            <li class="c-header-nav-item d-md-down-none mx-2">
                <a class="c-header-nav-link" href="#">
                    <i class="fas fa-envelope-open"></i>
                </a>
            </li>
            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar">
                        <img class="c-avatar-img" src="/systemAssets/images/avatars/avatar2.jpg" alt="user@email.com">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                <a class="dropdown-item" href="#">
                    Updates<span class="badge badge-info ml-auto">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    Messages<span class="badge badge-success ml-auto">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    Tasks<span class="badge badge-danger ml-auto">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    Comments<span class="badge badge-warning ml-auto">42</span>
                </a>
                <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Payments<span class="badge badge-secondary ml-auto">42</span></a>
                <a class="dropdown-item" href="#">Projects<span class="badge badge-primary ml-auto">42</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Lock Account</a>
                <a class="dropdown-item" href="#">Logout</a>
                </div>
            </li>
        </ul>
        
        <div class="c-subheader px-3">
            <ol class="breadcrumb border-0 m-0">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </header>
</template>
<script>
export default {
    
}
</script>
<style scoped>
.c-header{
    border-bottom: 0px;
}
</style>