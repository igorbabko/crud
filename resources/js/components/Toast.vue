<template>
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: relative; min-height: 200px;">
        <div class="toast-header" style="position: absolute; top: 0; right: 0;">
            <!-- <img src="..." class="rounded mr-2" alt="..."> -->
            <strong class="mr-auto">Done</strong>
            <!-- <small>11 mins ago</small> -->
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">Operation successfull</div>
    </div>
</template>

<script>
    export default {
        mounted () {
            $('.toast').toast({delay: 3000})
        }
    }
</script>
