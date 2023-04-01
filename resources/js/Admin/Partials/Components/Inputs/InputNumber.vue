<template>
		<div class="form-group">
		    <label :for="PropName">{{PropLable}}</label>
		    <input :type="'number'" :placeholder="PropPlaceholder" v-model="data" class="form-control" 
			:id="PropName"  :name="PropName"  />
			
			<b-alert show variant="danger" v-for="err in PropErrors" :key="err"  >
					{{ err }}
			</b-alert>
		</div>
</template>

 
<script> 
export default {
    data( ) { return {
    	data : this.value

    } } ,
    props   : {
    	PropLable :null,
    	PropPlaceholder :null,
    	PropType  :null,
    	PropName : null,
    	PropErrors    : [] ,	
    	value :null,
    } ,
    watch   : {
    	data: function() {
        	this.$emit( 'input'  , String( this.data ) ) ;
        	this.$emit( 'change' , String( this.data ) ) ;  
    	}
    } ,

} </script>