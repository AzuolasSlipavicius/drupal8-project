<?php

namespace Drupal\cdp_pages\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Returns responses for cdp_pages routes.
 */
class CdpPagesController extends ControllerBase {

  /**
   * Return HTTP response.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   HTTP response.
   */
  public function response(): Response {
    $string = 'It works!';
    return new Response($string);
  }

  /**
   * Return HTTP response as REST response.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   HTTP response.
   */
  public function apiResponse(): Response {
    $string = 'It works!';
    $response = [
      'status' => TRUE,
      'message' => $string,
    ];
    $encoded_response = json_encode($response);
    return new Response($encoded_response);
  }

  /**
   * Return string as page content.
   *
   * This will not work, because Drupal only handles either HTTP responses or
   * render arrays.
   *
   * @return string
   *   String as page content, but error will be displayed.
   */
  public function string(): string {
    return 'It does not work!';
  }

  /**
   * Return custom markup as page content.
   *
   * @return array
   *   Page content array.
   */
  public function renderMarkup(): array {
    $string = 'It works';
    return [
      '#markup' => $string,
    ];
  }

  /**
   * Return inline template as page content.
   *
   * @return array
   *   Page content array.
   */
  public function renderInlineTemplate(): array {
    $string = 'It works!';
    $template = '<h1>Inline template says: {{ string }}</h1>';
    $context = [
      'string' => $string,
    ];
    return [
      '#type' => 'inline_template',
      '#template' => $template,
      '#context' => $context,
    ];
  }

  /**
   * Return item as page content.
   *
   * @return array
   *   Page content array.
   */
  public function renderItem(): array {
    $string = 'It works!';
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $string,
    ];

    return $build;
  }

  /**
   * Return custom template as page content.
   *
   * @return array
   *   Page content array.
   */
  public function renderCustom(): array {
    $string = 'It works!';
    return [
      '#theme' => 'cdp_page',
      '#string' => $string,
    ];
  }

  /**
   * Return custom template with no variables as page content.
   *
   * @return array
   *   Page content array.
   */
  public function renderCustomNoVariables(): array {
    return [
      '#theme' => 'cdp_page',
    ];
  }

  /**
   * Return custom template that was processed by preprocess hook.
   *
   * @return array
   *   Page content array.
   */
  public function renderCustomWithPreprocess(): array {
    $string = 'It works!';
    return [
      '#theme' => 'cdp_page_with_preprocess',
      '#string' => $string,
    ];
  }

  /**
   * Return custom template with additional template variants.
   *
   * @return array
   *   Page content array.
   */
  public function renderCustomWithSuggestion(): array {
    $string = 'It works!';
    return [
      '#theme' => 'cdp_page_with_suggestion',
      '#string' => $string,
    ];
  }

  /**
   * Return custom template that is overriden by theme.
   *
   * @return array
   *   Page content array.
   */
  public function renderCustomWithTemplateInTheme(): array {
    $string = 'It works!';
    return [
      '#theme' => 'cdp_page_with_theme_template',
      '#string' => $string,
    ];
  }

  /**
   * Return multiple items as page content.
   *
   * @return array
   *   Page content array.
   */
  public function renderMultipleItems(): array {
    $string = 'It works!';
    $second_string = 'It works for real!';
    $first_item = [
      '#type' => 'item',
      '#markup' => $string,
    ];
    $second_item = [
      '#type' => 'item',
      '#markup' => $second_string,
    ];
    return [
      $first_item,
      $second_item,
    ];
  }

  /**
   * Return multiple different items and custom templates as page content.
   *
   * @return array
   *   Page content array.
   */
  public function renderMultipleDifferent(): array {
    $string = 'It works!';
    $item = [
      '#type' => 'item',
      '#markup' => $string,
    ];
    $second_string = 'I can\'t believe this!';
    $second_template = '<h1>Inline template says: {{ second_string }}</h1>';
    $second_context = [
      'second_string' => $second_string,
    ];
    $second_inline_template = [
      '#type' => 'inline_template',
      '#template' => $second_template,
      '#context' => $second_context,
    ];
    $third_string = 'This is magic!';
    $third_cdp_page = [
      '#theme' => 'cdp_page',
      '#string' => $third_string,
    ];
    return [
      $item,
      $second_inline_template,
      $third_cdp_page,
    ];
  }

  /**
   * If user comes to this page, redirect to another page.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   *   Page content array.
   */
  public function redirectFromPage(): RedirectResponse {
    return $this->redirect('cdp_pages.pages.redirect.to');
  }

  /**
   * Redirect to this page from custom redirect page.
   *
   * @return array
   *   Page content array.
   */
  public function redirectToPage(): array {
    $string = 'I was redirected here!';
    return [
      '#type' => 'item',
      '#markup' => $string,
    ];
  }

  /**
   * Redirect to this page if no front page is configured.
   *
   * @return array
   *   Page content array.
   */
  public function customFrontPageIfNoFrontPageIsConfigured(): array {
    $string = 'Look at me! I\'m the Front Page now!';
    return [
      '#theme' => 'cdp_page',
      '#string' => $string,
    ];
  }

}
