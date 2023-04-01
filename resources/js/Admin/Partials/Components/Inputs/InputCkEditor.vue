<template>
		<div class="form-group">
		    <label :for="PropName">{{PropLable}}</label>

            <ckeditor  
                :id="PropName" 
                :editor="editor" 
                v-model="data" 
                :config="editorConfig" 
                :name="PropName"  
                @change="change()"
            ></ckeditor>
			<b-alert show variant="danger" v-for="err in PropErrors" :key="err"  >
					{{ err }}
			</b-alert>
		</div>





		
</template>


<script> 
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


export default {
    data( ) { return {
    	data : this.value,

        editor: ClassicEditor,
        editorData: '<p>Content of the editor.</p>',
        editorConfig: {
            // The configuration of the editor.
        }
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
    	data( ) {
    	    this.data = this.data ;
        	this.$emit( 'input'  , String( this.data ) ) ;
        	this.$emit( 'change' , String( this.data ) ) ;    
    	}
    } ,
    methods : {
        change( ) {
            console.log(this.data);
        	this.$emit( 'input'  , String( this.data ) ) ;
        	this.$emit( 'change' , String( this.data ) ) ;        
        }
    } ,
} </script>