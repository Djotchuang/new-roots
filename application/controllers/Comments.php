<?php
class Comments extends CI_Controller
{
	public function create($post_id)
	{
		$slug = $this->input->post('slug');
		$data['post'] = $this->post_model->get_posts($slug);
		$this->form_validation->set_rules('body', 'Body', 'required');


		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('posts/view', $data);
			$this->load->view('templates/footer');
		} else {
			$this->comment_model->create_comment($post_id);
			$this->load->helper('timeelapsed_helper');
			redirect('posts/' . $slug);
		}
	}

	public function get_comments_count()
	{
		$id = $_POST["post_id"];
		$data = $this->comment_model->get_comments_count($id);
		echo $data;
	}
}
