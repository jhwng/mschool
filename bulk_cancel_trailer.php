    <tr height="25" bgcolor="#E2D8F3">
      <td colspan="8" bgcolor="#FFBA75"><div align="center" class="style9">
          <input name="submit" type="submit" class="btn" id="submit"
          onClick='document.form2.action = "bulk_cancel.php?action=2"; return true'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Confirm Bulk Cancel"/>
          <input name="submit" type="submit" class="btn" id="submit"
          onClick='document.form2.action = "bulk_cancel.php"; return true'
   onmouseover="this.className='btn btnhov'" onmouseout="this.className='btn'" value="Cancel"/>
	  </div></td>
    </tr>
  </td>
  </table>
  <input type="hidden" name="num_rows" id="num_rows" value="<?php echo $j; ?>" >
  <input type="hidden" name="cancel_reason" id="cancel_reason" value="<?php echo $cancelReason; ?>" >
  <input type="hidden" name="remarks" id="remarks" value="<?php echo $remarks; ?>" >
  </form>
  </tr>
  </table>
