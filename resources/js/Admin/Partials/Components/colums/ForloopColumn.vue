<template>
    <div>
        <span  v-for="( valLoop , Loopkey )  in LoopOnColumn" :key="Loopkey"   >
            <span
            v-if="valLoop && ValueColumn && ValueColumn[valLoop] && ValueColumn[valLoop] !== 'null'"
            v-html="ValueColumn[valLoop]"
             > 
             
            </span>
            <br> 
        </span>  

    </div>


</template>

<script> 

export default {
    name:"forloopColumn",
    components:{
    },

    data( ) { return {
     } } ,

    props   : {
        ValueColumn :null,
        LoopOnColumn :[],
    } ,

} </script>