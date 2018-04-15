</table>
</td>
</tr>
</table>
<p>
<table width="700">
<tr>
<td width="120">&nbsp;</td>
<td align="center">
<input name="update" type="submit" class="btn" id="update" onclick='document.form2.action="teacher_rates.php?action=2"; return true;' onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Update Teacher Rates" />
    <input name="teacher_id" type="hidden" id="teacher_id" value="<?php echo $teacher_id; ?>"/>
    <input name="teacher" type="hidden" id="teacher" value="<?php echo $teacher; ?>"/>
    <input name="num_entries" type="hidden" id="num_entries" value="<?php echo $numRows; ?>"/>
</td>
</tr>
</table>


</form>
