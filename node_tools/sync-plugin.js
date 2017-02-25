import cpx from 'cpx';

const source = ["./{settings,utils}/**","./mailgun-for-wp.php"];
const destination = "c:\\xampp\\htdocs\\wordpress\\wp-content\\plugins\\mailgun-for-wp";
source.map(src => {
  cpx
    .watch(src, destination);
});