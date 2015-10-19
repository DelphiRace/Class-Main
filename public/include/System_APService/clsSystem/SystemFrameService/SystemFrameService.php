<?php		
	namespace SystemFrameService;
	
	class clsFrame {
	#新增、修改、刪除按鈕產生
		public function CreateBasisOptionBtn($BtnType, $BtnContent, $DataArray, $ActionID = 'uid', $BtnStyleClass = ''){
			$btnStr = '';
			$btnSetArr = ["Insert","Modify","Delete"];
			if(!empty($DataArray) or $BtnType == 'Insert'){
				if(in_array($BtnType,$btnSetArr)){
					$btnStr = $this->CreateBtn($BtnType, $BtnContent, $DataArray, $ActionID, $BtnStyleClass);
				}else{
					$btnStr = 'Btn Not Setting';
				}
			}else{
				$btnStr = 'Btn Not Setting';
			}
			return $btnStr;
		}
		//創建新增按鈕，非public函式
		private function CreateBtn($BtnType, $BtnContent, $DataArray, $ActionID, $BtnStyleClass){
			$BtnContent = str_replace("@@class@@",$BtnStyleClass,$BtnContent);
			if(!empty($DataArray)){
				$BtnContent = str_replace("@@actionID@@",$DataArray[$ActionID],$BtnContent);
			}
			$BtnContent = str_replace("@@onclick@@","frameBasisBtn('".$BtnType."');",$BtnContent);
			return $BtnContent;
		}
		
		
	}
?>