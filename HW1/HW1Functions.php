<?php
/**
 * User: aviginsberg
 * IDE: PhpStorm.
 * Date: 5/24/15
 */

class HW1Functions {

    function rtrim_value(&$value)
    {
        $value = rtrim($value);
    }


    //Sort File in ascending order and write it to new file.
    //Returns TRUE on success and FALSE on failure.
    function Sort_File_Ascending($filein, $fileout){

        //Read file into an array
        $filedata = file($filein);
            if(!$filedata){echo "Failed to read in $filein\n"; return FALSE;}

        //remove newline from end of each element
        array_walk($filedata, array($this, 'rtrim_value'));

        sort($filedata);

        //print_r($filedata);

        //open/create the file
        $fp = fopen($fileout, 'w');
            if(!$fp){echo "Failed to open/create $fileout\n"; return FALSE;}

        //loop thru the sorted array and write the contents to the file
        foreach($filedata as $fileline){
            $fwrite = fwrite($fp, $fileline."\n");
                if(!$fwrite){echo "Failed to write data to file.\n"; return FALSE;}
        }

        //close the file
        $fclose = fclose($fp);
            if(!$fclose){echo "Failed to close file $fileout\n"; return FALSE;}

        //function was successful - return TRUE
        return TRUE;
    }


    //Merges 2 files that are already in Ascending order, keeping them in ascending order.
    //Duplicates are removed
    //Returns TRUE on success and FALSE on failure.
    function Merge_2_Sorted_Ascending($file1in, $file2in, $fileout){

        //Read our files into arrays
        $data1 = file($file1in);
        $data2 = file($file2in);
            if(!$data1 || !$data2){return FALSE;}


        //Open/create the file for writing
        $fp = fopen($fileout, 'w');
        if(!$fp){echo "Failed to open/create $fileout\n"; return FALSE;}


        //compare thru the arrays and write to the file
        while(count($data1)>0 && count($data2)>0){

            //Do our comparison and write each time
            if(strcmp($data1[0],$data2[0])<0){
                //$data1[0] is smaller. write it to the file.
                $fwrite = fwrite($fp, $data1[0]);
                    if(!$fwrite){echo "Failed to write data1[0] to file.\n"; return FALSE;}

                //shift $data1[0] off the top of the array
                array_shift($data1);

            }elseif(strcmp($data1[0],$data2[0])>0){
                //$data2[0] is smaller. write it to the file.
                $fwrite = fwrite($fp, $data2[0]);
                    if(!$fwrite){echo "Failed to write data2[0] to file.\n"; return FALSE;}

                //shift $data1[0] off the top of the array
                array_shift($data2);
            }else{
                //$data1[0] and $data2[0] are the same. write 1 and shift from both.
                $fwrite = fwrite($fp, $data1[0]);
                    if(!$fwrite){echo "Failed to write data1[0] to file.\n"; return FALSE;}
                array_shift($data1);
                array_shift($data2);
            }

        }

        //If one of our files is at the end, write the rest of the other file out to our merged file
        if(count($data1)<1){
            foreach($data2 as $fileline){
                $fwrite = fwrite($fp, $fileline);
                if(!$fwrite){echo "Failed to write remainder of data2 to file.\n"; return FALSE;}
            }
        }
        if(count($data2)<1){
            foreach($data1 as $fileline){
                $fwrite = fwrite($fp, $fileline);
                if(!$fwrite){echo "Failed to write remainder of data1 to file.\n"; return FALSE;}
            }
        }


        //close the file
        $fclose = fclose($fp);
        if(!$fclose){echo "Failed to close file $fileout\n"; return FALSE;}

        //function was successful - return TRUE
        return TRUE;
    }









}

?>