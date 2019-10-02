export function resetFile($input) {
    $input.wrap('<form>').closest('form').get(0).reset();
    $input.unwrap()
}
