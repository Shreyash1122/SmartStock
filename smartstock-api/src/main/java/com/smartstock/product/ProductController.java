package com.smartstock.product;

import jakarta.validation.Valid;
import java.net.URI;
import java.util.List;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.support.ServletUriComponentsBuilder;

@RestController
@RequestMapping("/api/products")
@CrossOrigin(origins = "http://localhost:5173")
public class ProductController {
  private final ProductRepository products;
  public ProductController(ProductRepository products) { this.products = products; }
  @GetMapping public List<Product> all() { return products.findAll(); }
  @GetMapping("/{id}") public ResponseEntity<Product> byId(@PathVariable String id) { return products.findById(id).map(ResponseEntity::ok).orElseGet(() -> ResponseEntity.notFound().build()); }
  @PostMapping public ResponseEntity<Product> create(@Valid @RequestBody Product product) {
    Product saved = products.save(product);
    URI location = ServletUriComponentsBuilder.fromCurrentRequest().path("/{id}").buildAndExpand(saved.id()).toUri();
    return ResponseEntity.created(location).body(saved);
  }
  @PutMapping("/{id}") public ResponseEntity<Product> update(@PathVariable String id, @Valid @RequestBody Product product) {
    return products.existsById(id) ? ResponseEntity.ok(products.save(new Product(id, product.sku(), product.name(), product.category(), product.brand(), product.costPrice(), product.sellingPrice(), product.reorderLevel(), product.status()))) : ResponseEntity.notFound().build();
  }
}
