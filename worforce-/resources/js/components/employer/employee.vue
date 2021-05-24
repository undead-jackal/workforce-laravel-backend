<template>
    <div class="body">
        <div class="employee card">
            <div class="header">
                <span></span>
                <div class="filter">
                    <input type="date" class="form-control form-control-sm" name="" id="">
                    <button class="btn btn-sm btn-success">Filter</button>
                </div>
            </div>
            <div class="content">
                <table class="table table-striped">
                    <thead>
                        <th>Employee Name</th>
                        <th>Start Date - End Date</th>
                        <th>Status</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="avatar-td">
                                <img class="avatar-appl" src="/systemAssets/images/avatars/avatar2.jpg" alt="user@email.com">
                                <span>Milim Navaa</span> 
                            </td>
                            <td> <span class="badge badge-info">1/31/1998 - 3/26/2021</span> </td>
                            <td>Completed</td>
                            <td>
                                <button class="btn btn-sm btn-info">Rate & Pay</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="avatar-td">
                                <img class="avatar-appl" src="/systemAssets/images/avatars/avatar2.jpg" alt="user@email.com">
                                <span>Milim Navaa</span> 
                            </td>
                            <td> <span class="badge badge-info">1/31/1998 - current</span> </td>
                            <td>Inprogress</td>
                            <td>
                                <button class="btn btn-sm btn-info">End Contract</button>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style scoped>
.body{
    width: 100%;
    display: flex;
    justify-content: center;
}

.employee{
    width: 680px;
    background-color: var(--white);
    border-radius: 15px;
}  
.header{
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    padding: 1rem;
    background-color: var(--dominant);
    display: flex;
    align-items: center;
}

.header span{
    font-size: 1rem;
    color: var(--white);
    font-weight: 600;
}

.avatar-td{
    display: flex;
    align-items: center;
}

.avatar-td img{
    margin-right: 20px;
}

.avatar-appl{
    width: 40px;
    height: 40px;
    border-radius: 100%;
}

.header .filter{
    margin-left: auto;
    display: flex;
}

.header .filter input{
    outline: 0px;
}

.header .filter button{
    margin-left:20px
}
</style>