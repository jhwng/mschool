        <tr>
          <td height="15"><div align="center">
            <input name="date" type="text" id="date" size="10" maxlength="10" />
          </div></td>
          <td><div align="center">
            <input name="dow" type="text" id="dow" size="2" maxlength="2">
          </div></td>
          <td height="20"><div align="center">
            <input name="num_lessons" type="text" id="num_lessons" size="2" maxlength="2">
          </div></td>
          <td height="20"><div align="center">
            <input name="amount" type="text" id="amount" size="6" maxlength="6">
          </div></td>
          <td><div align="center">
            <input name="chq_num" type="text" id="chq_num" size="4" maxlength="4">
          </div></td>
          <td><div align="center">
            <input name="chq_name" type="text" id="chq_name" size="25" maxlength="45">
          </div></td>
          <td height="20"><div align="center">
            <input name="status" type="text" id="status" size="2" maxlength="1" />
            
            </div></td>
          <td><input name="payment_method" type="text" id="payment_method" size="20" maxlength="45" /></td>
          <td height="20"><div align="center">
            <input name="remarks" type="text" id="remarks" size="20" maxlength="100" />
          </div></td>
        </tr>
        
      </table></td>
      <td width="39">&nbsp;</td>
    </tr>
	<tr>
	<td>&nbsp;</td>
	<td width="727"><div align="center"> <br>
	<input name="update" type="submit" class="btn" id="update"
   onClick='document.form2.action="payment_schedule.php?action=2"; return true;'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Update Payment Schedule"/>
	  </div></td>
	<td>&nbsp;</td>
	</tr>
  </table>
</form>
