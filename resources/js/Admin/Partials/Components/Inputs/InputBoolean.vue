<template>
		<div class="form-group" style="padding-left: 25px;">
			<input type="checkbox" class="form-check-input"
				:id="PropName"
				:name="PropName"
				v-model="data"
				:checked="data"
				@change="change( $event.target.value )"
			/>
			<label :for="PropName" class="form-check-label">{{PropName}}</label>
		    <div>
				<b-alert show variant="danger" v-for="err in PropErrors" :key="err"  >
						{{ err }}
				</b-alert>
			</div>
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
        PropSelectOptions : null,

    } ,

	methods : {
        change( value ) {
			this.data =  this.data ? 1 : 0;
        	this.$emit( 'input'  ,  this.data ) ;
        	this.$emit( 'change' ,  this.data  ) ;        
        }
    } ,
} </script>