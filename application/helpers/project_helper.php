<?php 


// other data functions for loading prerequisite data 

function school_types($list = true){
  $query = "SELECT `typeId`, `typeTitle` FROM `school_type`;";
  $list = $this->db->query($query)->result();
  if($list == true){
    return $list;
  }
  $data = "<option>Select</option>";
  foreach ($list as $item) {
    $data .= "<option value='".$item->typeId."'>".$item->typeTitle."</option>";
  }
  return $data;
}

function districts($list = true){
  $query = "SELECT `districtId`, `districtTitle` FROM `district`";
  $list = $this->db->query($query)->result();
  if($list == true){
    return $list;
  }
      $data = "<option>Select</option>";
      foreach ($list as $item) {
        $data .= "<option value='".$item->districtId."'>".$item->districtTitle."</option>";
      }
      return $data;
}

function gender_of_school($list = true){
  $query = "SELECT `genderOfSchoolId`, `genderOfSchoolTitle` FROM `genderofschool`";
  $list = $this->db->query($query)->result();
  if($list == true){
    return $list;
  }
    $data = "<option>Select</option>";
    foreach ($list as $item) {
      $data .= "<option value='".$item->genderOfSchoolId."'>".$item->genderOfSchoolTitle."</option>";
    }
    return $data;
}

function level_of_institute($list = true){
  $query = "SELECT `levelofInstituteId`, `levelofInstituteTitle` FROM `levelofinstitute`";
  $list = $this->db->query($query)->result();
  if($list == true){
    return $list;
  }
    $data = "<option>Select</option>";
    foreach ($list as $item) {
      $data .= "<option value='".$item->levelofInstituteId." set_select('levelofInstituteId', '".$item->levelofInstituteId."', TRUE); ?> >".$item->levelofInstituteTitle."</option>";
    }
    return $data;

}

function registration_type($list = true){
  $query = "SELECT `regTypeId`, `regTypeTitle` FROM `reg_type`;";
  $list = $this->db->query($query)->result();
  if($list == true){
    return $list;
  }
      $data = "<option>Select</option>";
      foreach ($list as $item) {
        $data .= "<option value='".$item->regTypeId."'>".$item->regTypeTitle."</option>";
      }
      return $data;
}

function tehsils($list = true){
  $query = "SELECT `tehsilId`, `tehsilTitle`, `district_id` FROM `tehsils`;";
  $list = $this->db->query($query)->result();
  if($list == true){
    return $list;
  }
      $data = "<option>Select</option>";
      foreach ($list as $item) {
        $data .= "<option value='".$item->tehsilId."'>".$item->tehsilTitle."</option>";
      }
      return $data;
}

function ucs($list = true){
  $query = "SELECT `ucId`, `ucTitle`, `tehsil_id` FROM `uc`;";
  $list = $this->db->query($query)->result();
  if($list == true){
    return $list;
  }
      $data = "<option>Select</option>";
      foreach ($list as $item) {
        $data .= "<option value='".$item->ucId."'>".$item->ucTitle."</option>";
      }
      return $data;
}
