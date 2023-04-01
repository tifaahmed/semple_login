<template>
    <div>
        
        <span v-html="ValueColumn"  /> 
    </div>
</template>
<script> 
export default {
        name:"StringColumn",

    data( ) { return {

    } } ,
    props   : {
        ValueColumn :null,
    } ,

} </script>