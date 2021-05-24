<template>
    <div class="body">
        <div class="job-details card">
            <div class="header">
                <span>Job Details</span>
                <div class="filter">
                        <small>Accept Applications</small>
                        <label class="c-switch c-switch-pill c-switch-success">
                        <input type="checkbox" class="c-switch-input" checked>
                        <span class="c-switch-slider"></span>
                        </label>  
                        <button class="btn btn-sm btn-success">Invite more</button>                  
                </div>
            </div>
            <div class="content">
                <div>
                    <span class="p-header">Job Title</span>
                    <p>Web Developer PHP Laravel-Vue</p>
                </div>
                <div class="flexed-row">
                    <div class="first-col">
                        <span class="p-header">Level Required</span>
                        <p><span class="badge badge-info">Entry</span></p>
                    </div>
                    <div class="second-col">
                        <span class="p-header">Payment</span>
                        <p><span class="badge badge-info">$ 4000</span></p>
                    </div>
                </div>
                <div>
                    <span class="p-header">Description</span>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima illo quia odio nam eaque, maxime est quaerat nihil architecto corporis rerum, inventore delectus id labore error doloremque vitae distinctio reiciendis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima illo quia odio nam eaque, maxime est quaerat nihil architecto corporis rerum, inventore delectus id labore error doloremque vitae distinctio reiciendis</p>
                </div>
                <div>
                    <span class="p-header">Requirements</span>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima illo quia odio nam eaque, maxime est quaerat nihil architecto corporis rerum, inventore delectus id labore error doloremque vitae distinctio reiciendis
                        <ul>
                            <li>Lorem ipsum dolor sit amet consectetur </li>
                            <li>Lorem ipsum dolor sit amet consectetur </li>
                            <li>Lorem ipsum dolor sit amet consectetur </li>
                        </ul>
                    </p>
                </div>
                <div>
                    <span class="p-header">Skills</span>
                    <div class="skill-flex">
                        <span class="badge badge-info">Vue-js</span>
                        <span class="badge badge-info">Vue-js</span>
                        <span class="badge badge-info">Vue-js</span>
                    </div>
                </div>
                
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

.job-details{
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
    align-items: center;
    color: var(--white);
}

.header .filter label{
    margin-left:15px;
    margin-bottom: 0px;
}

.p-header{
    font-size: 1rem;
    font-weight: 600;
    color:var(--accent)
}

.content{
    padding: 1.5rem;
}

.badge{
    font-size:15px;
    padding: 5px;
}

.flexed-row{
    display: flex;
    align-items: center;
}

.flexed-row .second-col{
    margin-left: 20px;
}

.skill-flex{
    display: flex;
}

.skill-flex span{
    margin:5px
}



</style>