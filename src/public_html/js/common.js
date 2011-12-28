function toggleDisplay(ctr)
{
  control = document.getElementById(ctr);
  if(control.style.display == 'none')
  {
    control.style.display = 'block';
  }else if(control.style.display == 'block')
  {
    control.style.display = 'none';
  }
}