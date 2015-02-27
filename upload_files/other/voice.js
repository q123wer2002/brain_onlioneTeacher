      function doSend(frm){
      	if(!frm.name.value){
      		alert('名前は必須です');
      		return false;
      	}
      	if(!frm.occupation.value){
      		alert('職業は必須です');
      		return false;
      	}
      	if(!frm.email.value){
      		alert('メールアドレスは必須です');
      		return false;
      	}
       	if(!frm.history.value){
      		alert('ぐんぐん英会話歴は必須です');
      		return false;
      	}
       	if(!frm.usage.value){
      		alert('ご活用方法は必須です');
      		return false;
      	}
       	if(!frm.file1.value.match(/\.(jpg|gif|png)$/i)){
      		alert('添付ファイルの形式はJPEG,GIF,PNGのいずれかです');
      		return false;
      	}
      	frm.submit();
      }
