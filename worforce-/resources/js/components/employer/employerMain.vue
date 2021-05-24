<template>
    <div class="j-body-main">
        <div class="title-holder">
            <div class="first-col">
                <span>Jobs Post</span>
                <p>Here you can view and manage all you posted jobs</p>
            </div>
            <div class="second-col">
                <button class="btn-post">Post Job</button>
            </div>
        </div>
        <div class="content-holder">
            <div class="job_div card">
                <div class="job-div-header">
                    <span class="job-title">Web Developer PHP Laravel-Vue</span>
                </div>
                <div class="job-sub-header">
                    <span class="badge badge-info">$ 4000</span>
                    <span class="badge badge-info">ENTRY LEVEL</span>
                </div>
                <div class="job-body">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, aspernatur? Quidem nobis eius in vero! In distinctio obcaecati voluptatem alias, voluptatibus consectetur eum molestias voluptas expedita provident praesentium dicta ad!
                    </p>
                </div>
                <div class="job-foot">
                    <button  onclick="goto()" class="btn-manage">Manage</button>
                </div>
            </div>

            <div class="job_div card">
                <div class="job-div-header">
                    <span class="job-title">Web Developer PHP Laravel-Vue</span>
                </div>
                <div class="job-sub-header">
                    <span class="badge badge-info">$ 4000</span>
                    <span class="badge badge-info">ENTRY LEVEL</span>
                </div>
                <div class="job-body">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, aspernatur? Quidem nobis eius in vero! In distinctio obcaecati voluptatem alias, voluptatibus consectetur eum molestias voluptas expedita provident praesentium dicta ad!
                    </p>
                </div>
                <div class="job-foot">
                    <button  onclick="goto()" class="btn-manage">Manage</button>
                </div>
            </div>

            <div class="job_div card">
                <div class="job-div-header">
                    <span class="job-title">Web Developer PHP Laravel-Vue</span>
                </div>
                <div class="job-sub-header">
                    <span class="badge badge-info">$ 4000</span>
                    <span class="badge badge-info">ENTRY LEVEL</span>
                </div>
                <div class="job-body">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, aspernatur? Quidem nobis eius in vero! In distinctio obcaecati voluptatem alias, voluptatibus consectetur eum molestias voluptas expedita provident praesentium dicta ad!
                    </p>
                </div>
                <div class="job-foot">
                    <button  onclick="goto()" class="btn-manage">Manage</button>
                </div>
            </div>

            <div class="job_div card">
                <div class="job-div-header">
                    <span class="job-title">Web Developer PHP Laravel-Vue</span>
                </div>
                <div class="job-sub-header">
                    <span class="badge badge-info">$ 4000</span>
                    <span class="badge badge-info">ENTRY LEVEL</span>
                </div>
                <div class="job-body">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, aspernatur? Quidem nobis eius in vero! In distinctio obcaecati voluptatem alias, voluptatibus consectetur eum molestias voluptas expedita provident praesentium dicta ad!
                    </p>
                </div>
                <div class="job-foot">
                    <button  onclick="goto()" class="btn-manage">Manage</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{}
    }
}
</script>

<style scoped>
.j-body-main .title-holder .first-col span{
    font-size:1.3rem;
    color: var(--accent);
    font-weight: 700;
}

.j-body-main .title-holder .first-col p{
    font-size:1rem;
    color: var(--darkgray);
    font-weight: 400;
}
.j-body-main .title-holder .second-col{
    margin-left: auto;
}
.j-body-main .title-holder .second-col .btn-post{
    padding: 7px 24px;
    font-size: 1rem;
    border: 0;
    outline: 0px;
    background: var(--accent);
    color: var(--white);
    border-radius: 10px;
    font-weight: 600;

}

.j-body-main .title-holder{
    display: flex;
    background-color:var(--white);
    padding: 20px;
    position: sticky;
    top: 103px;
    z-index: 1;
}

.j-body-main .content-holder{
    padding: 2rem;
    display: flex;
    flex-wrap: wrap;
}
.j-body-main .content-holder .job_div{
    flex: 0 0 30%;
    margin: 1rem;
    padding: 1.5rem 1.5rem 0;
    border-radius: 15px;
    background: var(--white);
}

.job-title{
    font-size:1.1rem;
    font-weight: 600;
    color:var(--accent)
}

.job-body{
    font-size: 0.9rem;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;  
    height: 36%;
    overflow: hidden;
    padding: 10px 0px;
    color:var(--darkgray);
    text-align: justify;
}

.job-foot{
    padding: 1.3rem 0rem;
}

.job-foot button{
    width: 100%;
    padding: 5px;
    font-size: 1rem;
    color: var(--white);
    background: var(--dominant);
    border: 0px;
    outline: 0px;
    font-weight: 600;
    border-radius: 15px;
}

.job-sub-header{
    padding: 10px 0px;
}

.badge{
    font-size: 14px;
    padding: 4px 16px;
}

</style>