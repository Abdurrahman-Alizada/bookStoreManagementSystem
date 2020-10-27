<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users Component</div>

                    <div class="card-body">
                        I'm a users component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
  name : 'users',
  mounted() {
            console.log('Component mounted.')
        }
    }
</script>
